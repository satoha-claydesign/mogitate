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

<form action="/products/update" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="show-group">
        <div class="show__image">
            <img src="{{ asset('storage/img/' . $product->image) }}" alt="" />
            <div class="show__image-info">
                <label for="form-image">ファイルを選択</label>
                <input type="file" name="image" id="form-image">
                <span class="select-image">{{ $product->image }}</span>
            </div>
            <p class="form__error">
                @error('image')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div class="show__info">
            <p class="show__info-title">商品名</p>
            <input class="show__info-input" name="name" value="{{ $product->name }}">
             <p class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </p>
            <p class="show__info-title">値段</p>
            <input class="show__info-input" name="price" value="{{ $product->price }}">
            <p class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </p>
            <p class="show__info-title">季節</p>
            <div class="show__input--checkbox">
                @foreach ($allseasons as $allseason)
                <input class="show-checkbox" type="checkbox" name="allseason_ids[]" value="{{ $allseason->id }}" 
                @foreach ($product->seasons as $season) @if( $season->name === $allseason->name ) checked @endif 
                @endforeach /><label>{{ $allseason->name }}</label>
                @endforeach
            </div>
            <p class="form__error">
                @error('allseason_ids')
                {{ $message }}
                @enderror
            </p>
        </div>
    </div>
    <div class="show__description">
    <p class="show__info-title">商品説明</p>
    <textarea class="show__info-input description-box" name="description" value="{{ $product->description }}">{{ $product->description }}</textarea>
    </div>
    <p class="form__error">
        @error('description')
        {{ $message }}
        @enderror
    </p>
    <div class="show-form__btn-inner">
        <input type="hidden" name="id" value="{{ $product->id }}">
        <a class="show-form__back-btn btn" href="/">戻る</a>
        <input class="show-form__send-btn btn" type="submit" value="変更を保存" name="send">
    </div>
</form>
<form class="show__form-delete" action="/delete" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">
    <button class="show__form__delete-mark" type="submit" value=""><img src="{{ asset('storage/image/24937542.png') }}" alt=""></button>
</form>
@endsection