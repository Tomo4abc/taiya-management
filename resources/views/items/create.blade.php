@extends('layouts.app')

@section('content')

<!-- バリデーションエラーの表示 -->
@include('common.errors')

<!-- 新アイテムフォーム -->
<head>タイヤ登録画面</head>
<br>
<br>
<div class="container">
    <form action="{{ url('item') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- タイヤモデル、サイズ、本数 -->
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" placeholder="タイヤモデル" name="tire_id" id="item-tire_id" maxlength="100">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="サイズ" name="size" id="item-size" maxlength="100">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="本数" name="number" id="item-number" maxlength="100">
            </div>
        </div>
        <br>
    <!-- タイヤメーカー、インチ -->
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" placeholder="タイヤメーカー" name="tire_maker" id="item-tire_maker" maxlength="100">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="インチ" name="inch" id="item-inch" maxlength="100">
            </div>
        </div>
        <br>
    <!-- 年式記号、扁平率、残溝mm -->
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" placeholder="年式記号" name="year" id="item-year" maxlength="100">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="扁平率" name="oblateness" id="item-oblateness" maxlength="100">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="残溝mm" name="ditch" id="item-ditch" maxlength="100">
            </div>
        </div>
        <br>
    <!-- 評価、タイプ、強度数 -->
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" placeholder="評価" name="eveluation" id="item-eveluation" maxlength="100">
            </div>
            <div class="col">
            <select class="form-control" placeholder="タイプ" name="type_id" id="item-type_name">
                @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->type_name}}</option>
                @endforeach
            </select>
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="強度数" name="strength" id="item-strength" maxlength="100">
            </div>
        </div>
        <br>
    <!-- 仕様、ホイル、備考欄 -->
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" placeholder="仕様" name="specification" id="item-specification" maxlength="100">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="ホイル" name="foil" id="item-foil" maxlength="100">
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="備考欄" name="detail" id="item-detail" maxlength="100">
            </div>
        </div>
        <br>
        <!-- <div>タイヤモデル</div>
        <div>
            <input class="form-control" type="text" name="tire_id" id="item-tire_id" maxlength="100">
        </div>
        <div>サイズ</div>
        <div>
            <input class="form-control" type="text" name="size" id="item-size" maxlength="100">
        </div> -->
        <!-- <div>本数</div>
        <div>
            <input class="form-control" type="text" name="number" id="item-number" maxlength="100">
        </div> -->
        <!-- <div>タイヤメーカー</div>
        <div>
            <input class="form-control" type="text" name="tire_maker" id="item-tire_maker" maxlength="100">
        </div> -->
        <!-- <div>インチ</div>
        <div>
            <input class="form-control" type="text" name="inch" id="item-inch" maxlength="100">
        </div> -->
        <!-- <div>年式記号</div>
        <div>
            <input class="form-control" type="text" name="year" id="item-year" maxlength="100">
        </div>
        <div>扁平率</div>
        <div>
            <input class="form-control" type="text" name="oblateness" id="item-oblateness" maxlength="100">
        </div>
        <div>残溝mm</div>
        <div>
            <input class="form-control" type="text" name="ditch" id="item-ditch" maxlength="100">
        </div> -->
        <!-- <div>評価</div>
        <div>
            <input class="form-control" type="text" name="eveluation" id="item-eveluation" maxlength="100">
        </div>
        <div>タイプ</div>
        <div>
            <select class="form-control" name="type_id" id="item-type_name">
                @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->type_name}}</option>
                @endforeach
            </select>
        </div>
        <div>強度数</div>
        <div>
            <input class="form-control" type="text" name="strength" id="item-strength" maxlength="100">
        </div> -->
        <!-- <div>仕様</div>
        <div>
            <input class="form-control" type="text" name="specification" id="item-specification" maxlength="100">
        </div>
        <div>ホイル</div>
        <div>
            <input class="form-control" type="text" name="foil" id="item-foil" maxlength="100">
        </div> -->
        <!-- <div>入庫日</div>
        <div>
            <input class="form-control" type="text" name="date" id="item-date" maxlength="100">
        </div> -->
        <!-- <div>備考欄</div>
        <div>
            <input class="form-control" type="text" name="detail" id="item-detail" maxlength="100">
        </div> -->
        <!-- 写真アップロード作成 -->
        <div>写真アップロード</div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" name="image" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>
        <br>
        <br>
        <div>
            <button type="submit" class="btn btn-secondary">登録</button>
        </div>
    </form>
</div>

@endsection