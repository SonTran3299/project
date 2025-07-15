<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        $searchQuery = $request->query('query') ?? null;
        $sort  = $request->sort ?? 'latest';

        $arraySort = ['id', 'desc'];
        if ($sort === 'oldest') {
            $arraySort = ['id', 'asc'];
        }

        [$column, $sort] = $arraySort;

        $itemPerPage = config('my-config.item_per_page');
        if (!$searchQuery) {
            $datas = Product::orderBy($column,  $sort)->paginate($itemPerPage);
        } else {
            $datas = Product::where('name', 'LIKE', "%$searchQuery%")->orderBy($column,  $sort)->paginate($itemPerPage);
        }

        return view('admin.pages.product.list', ['datas' => $datas]);
    }

    public function create()
    {
        return view('admin.pages.product.create');
    }

    public function store(ProductStoreRequest $request)
    {
        $check = Product::create([
            'name' => $request->name,
            'slug' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status
        ]) ? 'Thành công' : 'Thất bại'; //mass asignment

        return redirect()->route('admin.product.list')->with('msg', $check);
    }

    public function destroy(Product $product)
    {
        $msg = $product->delete() ? 'Thành công' : 'Thất bại';

        return redirect()->route('admin.product.list')->with('msg', $msg);
    }

    public function detail(Product $product)
    {
        return view('admin.pages.product.detail', ['data' => $product]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->status = $request->status;
        $check = $product->save() ? 'Thành công' : 'Thất bại'; //update record

        return redirect()->route('admin.product.list')->with('msg', $check);
    }
}
