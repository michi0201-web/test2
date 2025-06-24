<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate Contact</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/products.css') }}" />
</head>


<body>

<header>
    <h1 class="logo">mogitate</h1>
</header>

<div class="container">
  <div class="sidebar">
    <h2>商品一覧</h2>
    <form method="GET" action="{{ route('products.index') }}">
      <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
      <button type="submit" class="btn-search">検索</button>

      <label style="margin-top: 15px;">価格順で表示</label>
      <select name="sort" onchange="this.form.submit()">
        <option value="">価格で並べ替え</option>
        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>価格が安い順</option>
        <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>価格が高い順</option>
      </select>
    </form>
        <div class="filter-tags mb-4">
        @if (!empty($keyword))
            <span class="tag">
                キーワード: {{ $keyword }}
                <a href="{{ route('products.index', array_merge(request()->except('keyword'), ['page' => 1])) }}" class="remove-tag">×</a>
            </span>
        @endif

        @if (!empty($sort))
            <span class="tag">
                並び順:
                @if ($sort === 'asc')
                    価格が安い順
                @elseif ($sort === 'desc')
                    価格が高い順
                @endif
                <a href="{{ route('products.index', array_merge(request()->except('sort'), ['page' => 1])) }}" class="remove-tag">×</a>
            </span>
        @endif
    </div>
  </div>

  

  <div class="main">
    <div class="header">
      <h1>商品一覧</h1>
      <a href="{{ route('products.create') }}" class="add-button">+ 商品を追加</a>
    </div>

    <div class="product-grid">
        @foreach ($products as $product)
        <a href="{{ route('products.show', $product->id) }}" class="product-card">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <div class="product-info">
                <p class="name">{{ $product->name }}</p>
                <p class="price">¥{{ number_format($product->price) }}</p>
            </div>
        </a>
        @endforeach
    </div>

    <div class="pagination">
      {{ $products->links('pagination::simple-bootstrap-4') }}
    </div>
  </div>
</div>

</body>

</html>