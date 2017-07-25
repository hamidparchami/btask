<?php

namespace App\Http\Controllers\Admin;


use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->orderBy('order', 'desc')->get();
        return view('admin.category.category_manage', compact('categories'));
    }

    public function getCreate($parent_id = null)
    {
        return view('admin.category.category_form', compact('parent_id'));
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'title'   => 'required|max:100',
            'desc'    => 'required',
            'url_key' => 'max:255',
            'order'   => 'sometimes|numeric',
        ];

        Validator::make($request->all(), $rules)->validate();

        $request['is_active'] = ($request['is_active'] == 'on' || $request['is_active'] == '1') ? 1 : 0;
        Category::create($request->all());

        return redirect('/admin/category/manage')->with('message', 'دسته با موفقیت ذخیره شد.');
    }

    public function getEdit($id, $parent_id = null)
    {
        $category = Category::find($id);
        return view('admin.category.category_form', compact('category', 'parent_id'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'title'   => 'required|max:100',
            'desc'    => 'required',
            'url_key' => 'max:255',
            'order'   => 'sometimes|numeric',
        ];

        Validator::make($request->all(), $rules)->validate();

        $request['is_active'] = ($request['is_active'] == 'on' || $request['is_active'] == '1') ? 1 : 0;
        $menu = Category::find($request->id);
        $menu->update($request->all());

        return redirect('/admin/category/manage')->with('message', 'دسته با موفقیت ذخیره شد.');
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
