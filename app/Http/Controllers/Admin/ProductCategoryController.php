<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategoryStoreRequest;
use App\Http\Requests\Admin\ProductCategoryUpdateRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
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
        //$datas = ProductCategory::orderBy('id', 'DESC')->paginate($itemPerPage);

        if (!$searchQuery) {
            $datas = DB::table('product_category')->orderBy($column, $sort)->paginate($itemPerPage);
        } else {
            $datas = DB::table('product_category')->where('name', 'LIKE', "%$searchQuery%")->orderBy($column, $sort)->paginate($itemPerPage);
        }

        return view('admin.pages.product_category.list', ['datas' => $datas]);
    }

    public function create()
    {
        return view('admin.pages.product_category.create');
    }

    public function store(ProductCategoryStoreRequest $request)
    {
        $check = ProductCategory::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]); //mass asignment

        return redirect()->route('admin.product_category.list')->with('msg', $check ? 'Success' : 'Fail');
    }

    public function makeSlug(Request $request)
    {
        $slug = Str::slug($request->slug);
        $result = DB::select('SELECT COUNT(*) as count FROM product_category WHERE slug = ?', [$slug]);

        if ($result[0]->count > 0) {
            $slug .= '-' . uniqid();
        }
        return response()->json(['slug' => $slug]);
    }

    public function destroy(ProductCategory $productCategory)
    {
        $msg = $productCategory->delete() ? 'Thành công' : 'Thất bại';

        return redirect()->route('admin.product_category.list')->with('msg', $msg);
    }

    public function detail(ProductCategory $productCategory)
    {
        return view('admin.pages.product_category.detail', ['data' => $productCategory]);
    }

    public function update(ProductCategoryUpdateRequest $request, ProductCategory $productCategory)
    {
        $productCategory->name = $request->name;
        $productCategory->slug = $request->slug;
        $productCategory->status = $request->status;
        $check = $productCategory->save() ? 'Thành công' : 'Thất bại';

        return redirect()->route('admin.product_category.list')->with('msg', $check);
    }

    public function restore(string|int $id)
    {
        $productCategory = ProductCategory::withTrashed()->find($id);

        $productCategory->restore();

        return redirect()->route('admin.product_category.list')->with('msg', 'success');
    }
}
