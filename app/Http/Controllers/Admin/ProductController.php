<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $fileName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $fileName = pathinfo($fileName, PATHINFO_FILENAME);

            $fileName = sprintf('%s_%s.%s', $fileName, uniqid(), $extension);

            $image->move(public_path('images/product/main_image'), $fileName);
        }

        $check = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
            'product_category_id' => $request->product_category_id,
            'discount_percentage' => $request->discount_percentage,
            'main_image' => $fileName,
        ]) ? 'Tạo sản phẩm thành công' : 'Tạo sản phẩm thất bại'; //mass asignment

        return redirect()->route('admin.product.list')->with('msg', $check);
    }

    public function destroy(Product $product)
    {
        $mainImage = $product->main_image;

        if ($mainImage) {
            $filePath = public_path('images/product/main_image/' . $mainImage);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $msg = $product->delete() ? 'Xóa sản phẩm thành công' : 'Xóa sản phẩm thất bại';
        return redirect()->route('admin.product.list')->with('msg', $msg);
    }

    public function detail(Product $product)
    {
        return view('admin.pages.product.detail', ['data' => $product]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount_percentage = $request->discount_percentage;
        $product->product_category_id = $request->product_category_id;
        $product->status = $request->status;
        $check = $product->save() ? 'Cập nhật sản phẩm thành công' : 'Cập nhật sản phẩm thất bại'; //update record

        return redirect()->route('admin.product.list')->with('msg', $check);
    }
}
