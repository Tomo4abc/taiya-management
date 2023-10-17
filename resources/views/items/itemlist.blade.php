@extends('layouts.app')

@section('content')

<!-- バリデーションエラーの表示 -->
@include('common.errors')

<div class="row">
    <!-- 新しい検索画面 -->
    <div class="col-2">
        <form action="{{ route('itemlist') }}" method="GET">
            {{ csrf_field() }}

            <!-- Keyword Search -->
            <div class="mb-3">
                <label for="keyword" class="form-label">キーワード</label>
                <input type="search" name="keyword" class="form-control" id="keyword" placeholder="キーワード">
            </div>

            <!-- Type Dropdown -->
            <div class="mb-3">
                <label for="type" class="form-label">タイヤタイプ</label>
                <select name="type" class="form-control" id="type">
                    <option value="" disabled selected>選択してください</option>
                    @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Size Range Search -->
            <div class="mb-3">
                <label for="min_size" class="form-label">最小</label>
                <input type="text" name="min_size" class="form-control" id="min_size" placeholder="最小サイズ">
            </div>

            <div class="mb-3">
                <label for="max_size" class="form-label">最大</label>
                <input type="text" name="max_size" class="form-control" id="max_size" placeholder="最大サイズ">
            </div>

            <!-- Search Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-secondary">{{ __('検索') }}</button>
            </div>
        </form>

        <!-- Export CSV Button -->
        <div class="text-center mt-3">
            <a href="{{ route('itemlist.export-csv') }}" class="btn btn-primary">CSVダウンロード</a>
        </div>
    </div>
    </form>

    <!-- 商品一覧 -->
    <div class="col-10">

        <!-- ページネーション-->
        <div class="text-center">
            {{ $items->links() }}
        </div>

        <!-- 商品登録 -->
        <div class="text-end">
            <a href="{{ route('item/create') }}" class="btn btn-secondary">
                {{ __('新規タイヤ登録') }}
            </a>
        </div>

        <table class="table">
            <thead>
                <tr class="table-success">
                    <th>タイヤモデル</th>
                    <th>サイズ</th>
                    <th>本数</th>
                    <th>タイヤメーカー</th>
                    <th>インチ</th>
                    <th>年式記号</th>
                    <th>扁平率</th>
                    <th>残溝mm</th>
                    <th>評価</th>
                    <th>タイプ</th>
                    <th>強度数</th>
                    <th>仕様</th>
                    <th>ホイル</th>
                    <th>入庫日</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td><a href="/detail/{{ $item->id }}">{{ $item->tire_id }}</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ $item->number }}</td>
                    <td>{{ $item->tire_maker }}</td>
                    <td>{{ $item->inch }}</td>
                    <td>{{ $item->year }}</td>
                    <td>{{ $item->oblateness }}</td>
                    <td>{{ $item->ditch }}</td>
                    <td>{{ $item->eveluation }}</td>
                    <td>{{ @$item->type->type_name }}</td>
                    <td>{{ $item->strength }}</td>
                    <td>{{ $item->specification }}</td>
                    <td>{{ $item->foil }}</td>
                    <td>{{ $item->created_at->format('Y年m月d日') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection