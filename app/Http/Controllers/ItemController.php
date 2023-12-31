<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\CSV;

use App\Models\Item;
use App\Models\Type;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ItemController extends Controller
{
    /**
     * コンストラクタ
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     * 
     * @param Request $request
     * @return Response
     */
    public function itemlist(Request $request)
    {
        $keyword = $request->input('keyword');
        if ($keyword !== null) {
            $keyword = mb_convert_kana($keyword, 'KV');
        }
        $typeId = $request->input('type'); // Get the selected 'type'
        $minSize = $request->input('min_size'); // Minimum size
        $maxSize = $request->input('max_size'); // Maximum size

        // $query = Item::query()->with(['type']);
        $query = Item::query()->leftjoin('types', 'items.type_id', '=', 'types.id')
            ->select('items.*');

        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {

                $query->where('tire_maker', 'LIKE', '%' . $keyword . '%')
                    ->orwhere('inch', 'LIKE', '%' . $keyword . '%')
                    // タイヤタイプの検索
                    ->orwhere('types.type_name', 'LIKE', '%' . $keyword . '%')
                    ->orwhere('size', 'LIKE', '%' . $keyword . '%')
                    ->orwhere('tire_id', 'LIKE', '%' . $keyword . '%');
            });
        }

        if (!empty($typeId)) {
            $query->where('items.type_id', $typeId); // Filter by selected 'type'
        }

        if (!empty($minSize) && !empty($maxSize)) {
            $query->whereRaw('CAST(size AS SIGNED) BETWEEN ? AND ?', [$minSize, $maxSize]);
        }

        $types = Type::orderBy('type_name')->get();
        /** ページネーション */
        $items = $query->paginate(15);
        return view('items.itemlist', ['items' => $items, 'types' => $types]);
    }

    public function detail($id)
    {
        $item = Item::with(['type'])->find($id);
        // dd($item);
        $types = Type::orderBy('id')->get();
        // dd($types);
        return view('items.detail', ['item' => $item, 'types' => $types]);
    }


    /**
     * CSVファイル 
     * 
     * 
     * 
     */
    public function exportCsv()
    {
        $items = Item::all(); // Retrieve the data to export
        $csvFileName = 'itemlist_export_' . Str::random(10) . '.csv';

        return response()->stream(function () use ($items) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'ID', 'Tire Maker', 'Inch', 'Type', 'Size', 'Tire ID',
            ]);

            foreach ($items as $item) {
                fputcsv($handle, [
                    $item->id, $item->tire_maker, $item->inch, $item->type->type_name, $item->size, $item->tire_id,
                ]);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ]);
    }

    public function update(Request $request)
    {
        $item = Item::find($request->id);
        // dd($item);
        // $item->name = $request->name;
        // $item->type_id = $request->type_id;
        // $item->detail = $request->number;
        // $item->zaiko = $request->zaiko;
        // $item->updated_at = now();
        $item->tire_id = $request->tire_id;
        $item->type_id = $request->type_id;
        $item->size = $request->size;
        $item->number = $request->number;
        $item->tire_maker = $request->tire_maker;
        $item->inch = $request->inch;
        $item->year = $request->year;
        $item->oblateness = $request->oblateness;
        $item->ditch = $request->ditch;
        $item->eveluation = $request->eveluation;
        $item->strength = $request->strength;
        $item->specification = $request->specification;
        $item->foil = $request->foil;
        //画像がある場合は、encoded_imageを用意する
        // dd($request->file('image'));
        if ($request->file('image')) {
            $file = file_get_contents($request->file('image'));
            $encoded_img = base64_encode($file);
            //ある時は上書き、ない時そのまま。
            $item->image = $encoded_img;
            //以下のmimeが必要ない。。。？
            // $extension = pathinfo($file, PATHINFO_EXTENSION);
            // $item->mime = $extension;
        }
        $item->save();
        return redirect('/itemlist');
    }

    /**
     * アイテム登録
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'name' => 'required|max:100',
            // 'type' => 'required',
            // 'detail' => 'nullable|max:500',
            'tire_id' => 'nullable|max:500',
            'size' => 'required|numeric|max:500',
            'number' => 'required|numeric|max:100',
            'tire_maker' => 'required|max:100',
            'inch' => 'required|numeric|max:100',
            'year' => 'required|digits:4|integer|max:2500|min:2000',
            'oblateness' => 'nullable|max:500',
            'ditch' => 'nullable|max:500',
            'eveluation' => 'nullable|max:500',
            'type_id' => 'nullable|max:500',
            'strength' => 'nullable|max:500',
            'specification' => 'nullable|max:500',
            'foil' => 'nullable|max:500',
            'detail' => 'nullable|max:500',

        ]);
        // dd($request->all());

        //デフォルトがNull
        $encoded_img = null;
        $extension = null;
        //画像がある場合は、encoded_imageを用意する
        if ($request->image) {
            $file = file_get_contents($request->image);
            $encoded_img = base64_encode($file);
            $extension = $request->image->getClientOriginalExtension();
        }

        // 商品登録
        Item::create([
            // 'name' => $request->name,
            // 'detail' => $request->detail,
            // 'user_id' => $request->user_id,
            'type_id' => $request->type_id,
            'tire_id' => $request->tire_id,
            'size' => $request->size,
            'number' => $request->number,
            'tire_maker' => $request->tire_maker,
            'inch' => $request->inch,
            'year' => $request->year,
            'oblateness' => $request->oblateness,
            'ditch' => $request->ditch,
            'eveluation' => $request->evaluation,
            'strength' => $request->strength,
            'specification' => $request->specification,
            'foil' => $request->foil,
            'image' => $encoded_img,
            'mime' => $extension,
            // 登録日を取得
            'created_at' => (new Carbon($request->created_at))->toDateTimeString(),
        ]);

        return redirect('/itemlist');
    }
    /**
     * 種別の取得
     * 
     * @return Respons
     */
    public function create()
    {
        $types = Type::all();
        return view('items.create', ['types' => $types]);
    }

    public function destroy($id)
    {
        Item::destroy($id);
        return redirect('/itemlist');
    }

    /**
     * 削除処理 2023/08/08
     * 
     * 
     */
    // public function destroy(Request $request, Item $item)
    // {
    //     //Itemテーブルから指定のIDのレコード1件を取得
    //     $item = Item::find($request->id);
    //     // dd(Item::find($request->id));
    //     //レコードを削除
    //     $item->delete();

    //     //削除後一覧画面にリダイレクト
    //     return redirect()->route('itemlist');
    // }
}
