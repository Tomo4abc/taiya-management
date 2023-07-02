@extends('layouts.app')

@section('content')

<!-- 新アイテムフォーム -->
    <form action="/update/{{$item->id}}" method="post" enctype="multipart/form-data">
    <input type="number" class="form-control mb-3" name="id" value="{{$item->id}}" hidden>
        @csrf
<!-- タイヤモデル、サイズ、本数 -->
        <div class="row">
            <div class="col">
                <input class="form-control" placeholder="タイヤモデル" type="text" name="tire_id" value="{{$item->tire_id}}">
            </div>
            <div class="col">
                <input class="form-control" placeholder="サイズ" type="text" name="size" value="{{$item->size}}">
            </div>
            <div class="col">
            <input class="form-control" placeholder="本数" type="text" name="number" value="{{$item->number}}">
            </div>
        </div>
        <br>    
<!-- タイヤメーカー、インチ -->
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" placeholder="タイヤメーカー" name="tire_maker" value="{{$item->tire_maker}}">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="インチ" name="inch" value="{{$item->inch}}">
            </div>
        </div>
        <br>
<!-- 年式記号、扁平率、残溝mm -->
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" placeholder="年式記号" name="year" value="{{$item->year}}">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="扁平率" name="oblateness" value="{{$item->oblateness}}">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="残溝mm" name="ditch" value="{{$item->ditch}}">
            </div>
        </div>
        <br>
    <!-- 評価、タイプ、強度数 -->
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" placeholder="評価" name="eveluation" value="{{$item->eveluation}}">
            </div>
            <div class="col">
            <select class="form-control" placeholder="タイプ" name="type_id" id="item-type_name">
                @foreach($types as $type)
                <option value="{{$type->id}}" @if(@$item->type->id == $type->id) selected @endif>{{$type->type_name}}</option>
                @endforeach
            </select>
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="強度数" name="strength" value="{{$item->strength}}">
            </div>
        </div>
        <br>
    <!-- 仕様、ホイル、備考欄 -->
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" placeholder="仕様" name="specification" value="{{$item->specification}}">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="ホイル" name="foil" value="{{$item->foil}}">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="備考欄" name="detail" value="{{$item->detail}}">
            </div>
        </div>
        <br>
        <br>
        <!-- <div>タイヤモデル</div>
            <input class="form-control" type="text" name="tire_id" value="{{$item->tire_id}}">
        <div>サイズ</div>
            <input class="form-control" type="text" name="size" value="{{$item->size}}">
        <div>本数</div>
            <input class="form-control" type="text" name="number" value="{{$item->number}}"> -->
        <!-- <div>タイヤメーカー</div>
            <input class="form-control" type="text" name="tire_maker" value="{{$item->tire_maker}}">
        <div>インチ</div>
            <input class="form-control" type="text" name="inch" value="{{$item->inch}}"> -->
        <!-- <div>年式記号</div>
            <input class="form-control" type="text" name="year" value="{{$item->year}}">
        <div>扁平率</div>
            <input class="form-control" type="text" name="oblateness" value="{{$item->oblateness}}">
        <div>残溝mm</div>
            <input class="form-control" type="text" name="ditch" value="{{$item->ditch}}"> -->
        <!-- <div>評価</div>
            <input class="form-control" type="text" name="eveluation" value="{{$item->eveluation}}">
        <div>タイプ</div>
            <select class="form-control" name="type_id" id="item-type_name">
                @foreach($types as $type)
                <option value="{{$type->id}}" @if(@$item->type->id == $type->id) selected @endif>{{$type->type_name}}</option>
                @endforeach
            </select>
        <div>強度数</div>
            <input class="form-control" type="text" name="strength" value="{{$item->strength}}"> -->
        <!-- <div>仕様</div>
            <input class="form-control" type="text" name="specification" value="{{$item->specification}}">
        <div>ホイル</div>
            <input class="form-control" type="text" name="foil" value="{{$item->foil}}"> -->
<!-- <div>入庫日</div>
<div>
<input class="form-control" type="text" name="date" id="item-date" maxlength="100">
</div> -->
        <!-- <div>備考欄</div>
            <input class="form-control" type="text" name="detail" value="{{$item->detail}}"> -->
        <div>画像</div>
            <img src="data: {{ $item->mime }};base64, {{ $item->image }}">
            <input class="form-control" type="file" name="image" value="{{$item->image}}">
        <br>
        <br>
        <div>
            <button type="submit" class="btn btn-secondary">登録</button>
        </div>
    </form>
</div>

@endsection