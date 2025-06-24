<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Products;

class ProductsController extends Controller
{
    public function register()
  {
    return view('register');
  }

  public function products(RegisterRequest $request)
{
    $validated = $request->validated();

    $validated['season'] = implode(',', $request->input('season', []));

    // 画像の保存処理（必要であれば）
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $validated['image'] = $path;
    }

    Products::create($validated);

    return redirect('/products')->with('success', '登録が完了しました');
}

public function list(Request $request)
{
    $query = Products::query();

    // 複数キーワード検索（OR検索）
    if ($request->filled('keyword')) {
        $keywords = preg_split('/[\s　]+/u', $request->keyword);

        $query->where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('name', 'like', '%' . $word . '%');
            }
        });
    }

    // 並び替え処理
    if ($request->sort === 'asc') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort === 'desc') {
        $query->orderBy('price', 'desc');
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $products = $query->paginate(6);

    return view('products', [
        'products' => $products,
        'keyword' => $request->keyword,
        'sort' => $request->sort,
    ]);
}
public function show($id)
{
    $product = Products::findOrFail($id); // IDから商品を取得。なければ404

    return view('product_detail', compact('product')); // 商品詳細ページを表示
}

public function destroy($id)
{
    $product = Products::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index')->with('success', '商品を削除しました。');
}

public function update(Request $request, $id)
{
    $request->validate([
    'name' => 'required',
    'price' => 'required|numeric|min:0|max:10000',
    'description' =>'required|max:120',
    'season' => 'required|array|min:1',
    'image' => 'nullable|mimes:png,jpeg'
], [
    'name.required' => '商品名を入力してください',
    'price.required' => '値段を入力してください',
    'price.numeric' => '数値で入力してください',
    'price.min' => '0~10000円以内で入力してください',
    'price.max' => '0~10000円以内で入力してください',
    'season.required' => '季節を選択してください',
    'description.required' => '商品説明を入力してください',
    'description.max' => '120文字以内で入力してください',
    'image.required' => '商品画像を登録してください',
    'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
]);
// ResisterRequest.phpと同じ内容にしたかった


    $product = Products::findOrFail($id); // ✅ 修正済み！

    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $validated['season'] = is_array($request->input('season'))
    ? implode(',', $request->input('season'))
    : '';
    $product->description = $request->input('description');

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $product->image = $path;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', '商品を更新しました');
}


}
