<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate Contact</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>
 <header>
    <h1 class="logo">mogitate</h1>
  </header>

  <main>
    <h2 class="form-title">商品登録</h2>
    <form class="product-form" method="POST" action="/products" enctype="multipart/form-data" >
        @csrf
      <div class="form-group">
        <label>商品名 <span class="required">必須</span></label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
        <div class="form__error" style="color: red;">
        @error('name')
          {{ $message }}
        @enderror
        </div>
      </div>

      <div class="form-group">
        <label>値段 <span class="required">必須</span></label>
        <input type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力">
        <div class="form__error" style="color: red;">
        @error('price')
          {{ $message }}
        @enderror
        </div>
      </div>

      <div class="form-group">
        <label>商品画像 <span class="required">必須</span></label>
        <input type="file" name="image" value="{{ old('image') }}">
        <div class="form__error" style="color: red;">
        @error('image')
          {{ $message }}
        @enderror
        </div>
      </div>

      <div class="form-group">
        <label>季節 <span class="required">必須</span> <span class="note">複数選択可</span></label>
        <div class="season-options">
        <input type="checkbox" name="season[]" value="春" {{ in_array('春', old('season', [])) ? 'checked' : '' }}> 春
        <input type="checkbox" name="season[]" value="夏" {{ in_array('夏', old('season', [])) ? 'checked' : '' }}> 夏
        <input type="checkbox" name="season[]" value="秋" {{ in_array('秋', old('season', [])) ? 'checked' : '' }}> 秋
        <input type="checkbox" name="season[]" value="冬" {{ in_array('冬', old('season', [])) ? 'checked' : '' }}> 冬
          <div class="form__error" style="color: red;">
        @error('season')
          {{ $message }}
        @enderror
        </div>
        </div>
      </div>

      <div class="form-group">
        <label>商品説明 <span class="required">必須</span></label>
        <textarea placeholder="商品の説明を入力" name="description" value="{{ old('description') }}"></textarea>
        <div class="form__error" style="color: red;">
        @error('description')
          {{ $message }}
        @enderror
        </div>
      </div>

      <div class="form-actions">
        <a href="{{ route('products.index') }}" class="btn gray">戻る</a>
        <button type="submit" class="btn yellow">登録</button>
      </div>
    </form>
  </main>
</body>

</html>