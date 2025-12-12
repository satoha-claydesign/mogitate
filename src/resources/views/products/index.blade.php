@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="todo__alert">
  @if (session('message'))
  <div class="todo__alert--success">{{ session('message') }}</div>
  @endif @if ($errors->any())
  <div class="todo__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>

<div class="product__inner">
  <div class="product__title">
    <h2>商品一覧</h2>
    <button class="product__add-button">+商品を追加</button>
  </div>
  <div class="product__content">
    <div class="product__sidebar">
      <form class="keyword-search" action="">
        <input type="text" class="search-form__item-input keyword-input" name="keyword"
                placeholder="商品名で検索" />
        <button class="product__search-button">検索</button>
      </form>
      <h3 class="sort-title">価格帯で表示</h3>
      <form action="">
        <select class="search-form__item-input price-sort" name="" id="" placeholder="価格で並び替え" ></select>
      </form>
    </div>
    <div class="product__list">
      <div class="flex__item wrap">
        @foreach($products as $product)
        <div class="product__card">
            <div class="card__img">
                <img src="{{ asset('img/image'.$product->image.'.png') }}" alt="" />
            </div>
            <div class="card__content">
                <div class="tag">
                    <p class="card__tag">{{$product->name}}</p>
                    <p class="card__price">¥ {{$product->price}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    </div>
  </div>
</div>
@endsection