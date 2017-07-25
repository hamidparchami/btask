<?php

namespace App\Http\Controllers\Admin;


use App\Attribute;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AttributeController extends Controller
{
    public function index($category_id)
    {
        $attributes = Attribute::where('category_id', $category_id)->get();
        $category   = Category::findOrFail($category_id);
        return view('admin.attribute.attribute_manage', compact('attributes', 'category'));
    }

    public function getCreate($category_id)
    {
        return view('admin.attribute.attribute_create', compact('category_id'));
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'category_id' => 'required|numeric',
            'title'       => 'required|max:100',
            'desc'        => 'required',
            'field_type'  => 'max:255',
        ];

        Validator::make($request->all(), $rules)->validate();

        $request['is_active'] = ($request['is_active'] == 'on' || $request['is_active'] == '1') ? 1 : 0;
        Attribute::create($request->all());

        return redirect('/admin/attribute/manage/'.$request['category_id'])->with('message', 'ویژگی با موفقیت ذخیره شد.');
    }

    public function getEdit($id, $category_id)
    {
        $attribute = Attribute::find($id);
        return view('admin.attribute.attribute_edit', compact('attribute', 'category_id'));
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'title'       => 'required|max:100',
            'desc'        => 'required',
            'field_type'  => 'max:255',
        ];

        Validator::make($request->all(), $rules)->validate();

        $request['is_active'] = ($request['is_active'] == 'on' || $request['is_active'] == '1') ? 1 : 0;
        $menu = Attribute::find($request->id);
        $menu->update($request->all());

        return redirect('/admin/attribute/manage/'.$request['category_id'])->with('message', 'ویژگی با موفقیت ذخیره شد.');
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
