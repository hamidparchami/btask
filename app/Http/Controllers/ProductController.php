<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Category;
use App\Lib\GeneralFunctions;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * products list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProductsList()
    {
        $products   = Product::all();
        $categories = Category::where('is_active', 1)->get();
        $attributes = Attribute::where('is_active', 1)->get();

        return view('frontend.product.product_list', compact('products', 'categories', 'attributes'));
    }

    /**
     * represent filtered products
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFilteredProducts(Request $request)
    {
        sleep(1);

        //filter products by category
        $products = Product::where('id', '!=', 0);
        if (GeneralFunctions::isSetAndIsNotNull($request->input('categories_id'))) {
            $products = $products->whereIn('category_id', $request->input('categories_id'));
        }

        //filter products by attribute value
        if (GeneralFunctions::isSetAndIsNotNull($request->input('attributes_id'))) {
            $attribute_values = $request->input('attributes_id');
            $products = $products->whereHas('attributes', function($q)  use ($attribute_values) {
                $q->whereIn('value', $attribute_values);
            });
        }

        $products = $products->get();


        return view('frontend.product.product_filtered', compact('products'));
    }
}
