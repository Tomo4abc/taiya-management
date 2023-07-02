@extends('layouts.app')

@section('content')

<!-- バリデーションエラーの表示 -->
@include('common.errors')


<!-- 検索 -->
<form action="{{ route('itemlist') }}" method="GET" class="d-flex p-2">
    {{ csrf_field() }}
    
    <div class="col-auto">
        <input type="search" name="keyword" class="form-control me-2" aria-label="Search">
    </div>
    <div class="col-auto">
        <div class="ms-2"></div>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">
            {{ __('検索') }}
        </button>
    </div>
<!-- 商品登録 -->
    <div class="col-auto ms-auto">
        <a href="{{ route('item/create') }}" class="btn btn-secondary">
            {{ __('タイヤ登録') }}
        </a>
    </div>
</form>
<!-- ページネーション
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav> -->
<!-- ページネーション-->
<div class="mt-1 mb-1 row justify-content-center">
    {{ $items->links() }}
</div>

<!-- 商品一覧 -->
<table class="table">
    <thead>
        <tr class="table-success">
            <th>ＩＤ</th>
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
            <!-- <th>入庫日</th> 
            <th>備考欄</th> -->
        </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
        <tr>
            <td><a href="/detail/{{ $item->id }}">{{ $item->id }}</a></td>
            <td>{{ $item->tire_id }}</td>
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
        </tr>
        @endforeach
    </tbody>
</table>

@endsection