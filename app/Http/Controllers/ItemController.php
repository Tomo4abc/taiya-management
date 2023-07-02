<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\Item;
use App\Models\Type;

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

        $query = Item::query()->with(['type']);
                // ->select('items.tire_maker', 'items.tire_id', 'types.type_name',);

        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('tire_maker', 'LIKE', '%'.$keyword.'%');
                    // ->orwhere('type', 'LIKE', '%'.$keyword.'%')
                    // ->orwhere('tire_id', 'LIKE', '%'.$keyword.'%');
            });
        }
        $items = $query->paginate(10);
        return view('items.itemlist', ['items' => $items]);
    }

    public function detail($id)
    {
        $item = Item::with(['type'])->find($id);
        // dd($item);
        $types = Type::orderBy('id')->get();
        // dd($types);
        return view('items.detail', ['item' => $item,'types' =>$types]);
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
        if($request->file('image')){
            $file = file_get_contents($request->file('image'));
            $encoded_img = base64_encode($file);
            //ある時は上書き、ない時そのまま。
            $item->image=$encoded_img;
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
            'number' => 'required|max:100',
            'tire_maker' => 'required|max:100',
            'inch' => 'required|max:100',
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
        if($request->image){
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
}