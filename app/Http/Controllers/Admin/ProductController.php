<?php

namespace App\Http\Controllers\Admin;


use App\Attribute;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product.product_manage', compact('products'));
    }

    public function getCreate()
    {
        $categories = Category::where('is_active', 1)->orderBy('order', 'desc')->get();
        return view('admin.product.product_create', compact('categories'));
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'category_id' => 'required|numeric',
        ];

        Validator::make($request->all(), $rules)->validate();

        $product = Product::create($request->all());
        $attributes = Attribute::where('category_id', $product->category_id)->where('is_active', 1)->get();

        DB::transaction(function () use ($product, $attributes){
            foreach ($attributes as $attribute) {
                ProductAttribute::create(['product_id' => $product->id, 'attribute_id' => $attribute->id]);
            }
        });

        return redirect('/admin/product/edit/id/'.$product->id);
    }

    public function getEdit($id)
    {
        $product    = Product::find($id);
        return view('admin.product.product_edit', compact('product'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'title'     => 'required|max:100',
            'desc'      => 'required',
            'image_url' => 'required|max:255',
            'price'     => 'required|numeric|digits_between:0,11',
            'quantity'  => 'required|digits_between:0,6',
            'url_key'   => 'max:255',
        ];

        Validator::make($request->all(), $rules)->validate();

        //update product attributes
        $attributes = array_combine($request['attribute_id'], $request['attribute_value']);
        DB::transaction(function () use ($attributes){
            foreach ($attributes as $id => $value) {
                ProductAttribute::where('id', $id)->update(['value' => $value]);
            }
        });

        $request['is_active'] = ($request['is_active'] == 'on' || $request['is_active'] == '1') ? 1 : 0;
        $product = Product::find($request->id);
        $product->update($request->all());

        return redirect('/admin/product/manage')->with('message', 'محصول با موفقیت ذخیره شد.');
    }

    public function getDelete($id)
    {
        DB::transaction(function () use ($id){
            Category::destroy($id);
            Category::where('parent_id', $id)->delete();
        });

        return redirect('/admin/category/manage')->with('message', 'دسته به همراه دسته‌های زیر مجموعه با موفقیت حذف شدند.');
    }

}
