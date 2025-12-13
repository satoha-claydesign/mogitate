@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}" />
@endsection

@section('content')
<h1>商品詳細</h1>
<div class="show__inner">
    <nav>
        <ol class="breadcrumb">
            <li><a href="/">商品一覧</a></li>
            <li>{{ $product->name }}</li>
        </ol>
</nav>

<div class="show-group">
    <div class="show__image">
        <img src="{{ asset('img/'.$product->image.'.png') }}" alt="" />
        <div class="show__image-info">
            <button>ファイルを選択</button>
            <span>{{$product->image.'.png'}}</span>
        </div>
    </div>
    <div class="show__info">
        <p class="show__info-title">商品名</p>
        <input class="show__info-input" value="{{ $product->name }}">
        <p class="show__info-title">値段</p>
        <input class="show__info-input" value="{{ $product->price }}">
        <p class="show__info-title">季節</p>
        
        <div class="show__input--checkbox">
            @foreach ($allseasons as $allseason)
            <input class="show-checkbox" type="checkbox" name="season_check" value="{{ $allseason->id }}" 
            @foreach ($product->seasons as $season) @if( $season->name === $allseason->name ) checked @endif 
            @endforeach /><label>{{ $allseason->name }}</label>
            @endforeach
        </div>
       
    </div>
</div>
<div class="show__description">
<p class="show__info-title">商品説明</p>
    <textarea class="show__info-input description-box" value="{{ $product->description }}">{{ $product->description }}</textarea>
</div>
@endsection