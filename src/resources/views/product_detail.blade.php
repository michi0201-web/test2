<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate Contact</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/edit.css') }}" />
</head>


<body>


<div class="container">
  <p class="breadcrumb"><a href="{{ route('products.index') }}">商品一覧</a> > {{ $product->name }}</p>

  <div class="content">
    <form class="form" method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="image-preview">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        <label class="file-upload">
          ファイルを選択
          <input type="file" name="image"> <!-- ✅ formの中に移動 -->
        </label>
        <div class="form__error" style="color: red;">
          @error('image')
          {{ $message }}
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label>商品名</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}">
        <div class="form__error" style="color: red;">
          @error('name')
          {{ $message }}
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label>値段</label>
        <input type="text" name="price" value="{{ old('price', $product->price) }}">
        <div class="form__error" style="color: red;">
          @error('price')
          {{ $message }}
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label>季節</label>
        @php
        $selectedSeasons = is_array(old('season')) 
        ? old('season') 
        : (request()->old() ? [] : explode(',', $product->season ?? ''));
        @endphp

        <label>
          <input type="checkbox" name="season[]" value="春"
            {{ in_array('春', $selectedSeasons) ? 'checked' : '' }}> 春
        </label>

        <label>
          <input type="checkbox" name="season[]" value="夏"
            {{ in_array('夏', $selectedSeasons) ? 'checked' : '' }}> 夏
        </label>

        <label>
          <input type="checkbox" name="season[]" value="秋"
            {{ in_array('秋', $selectedSeasons) ? 'checked' : '' }}> 秋
        </label>

        <label>
          <input type="checkbox" name="season[]" value="冬"
            {{ in_array('冬', $selectedSeasons) ? 'checked' : '' }}> 冬
        </label>
        <div class="form__error" style="color: red;">
          @error('season')
          {{ $message }}
          @enderror
        </div>
      </div>

      <div class="form-group">
        <label>商品説明</label>
        <textarea name="description">{{ old('description', $product->description) }}</textarea>
        <div class="form__error" style="color: red;">
    @error('description')
      {{ $message }}
    @enderror
  </div>
      </div>

      <div class="buttons">
        <a href="{{ route('products.index') }}" class="btn back">戻る</a>
        <button type="submit" class="btn save">変更を保存</button>
      </div>
    </form>

    <!-- 削除フォーム -->
    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="delete-form" style="margin-top: 10px;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn delete">🗑</button>
    </form>
  </div>
</div>

</html>