<?php

use App\Attribute;
use App\Category;
use App\Product;
use App\ProductAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $category = Category::create(['title' => 'مد و لباس مردانه', 'desc' => 'مد و لباس مردانه', 'is_active' => 1]);
            $sub_category1 = Category::create(['parent_id' => $category->id, 'title' => 'لباس مردانه', 'desc' => 'لباس مردانه', 'is_active' => 1]);
            $sub_category2 = Category::create(['parent_id' => $category->id, 'title' => 'کیف', 'desc' => 'کیف', 'is_active' => 1]);

            $attribute1 = Attribute::create(['category_id' => $sub_category1->id, 'title' => 'رنگ', 'desc' => 'رنگ', 'field_type' => 'text', 'is_active' => 1]);
            $attribute2 = Attribute::create(['category_id' => $sub_category1->id, 'title' => 'سایز', 'desc' => 'سایز', 'field_type' => 'text', 'is_active' => 1]);
            $attribute3 = Attribute::create(['category_id' => $sub_category1->id, 'title' => 'جنس پارچه', 'desc' => 'جنس پارچه', 'field_type' => 'text', 'is_active' => 1]);

            $product1 = Product::create(['category_id' => $sub_category1->id, 'title' => 'پیراهن مردانه', 'model' => 'slim fit', 'desc' => 'پیراهن مردانه', 'image_url' => 'http://btask.dev/upload/photos/shares/aaa/581f2cb2ac9ae.jpg', 'price' => 900000, 'quantity' => 10, 'status' => 'Available']);
            $product2 = Product::create(['category_id' => $sub_category1->id, 'title' => 'شلوار مردانه', 'model' => 'slim fit', 'desc' => 'شلوار مردانه', 'image_url' => 'http://btask.dev/upload/photos/shares/aaa/581f2cb2ac9ae.jpg', 'price' => 1200000, 'quantity' => 10, 'status' => 'Available']);

            ProductAttribute::create(['attribute_id' => $attribute1->id, 'product_id' => $product1->id, 'value' => 'سفید']);
            ProductAttribute::create(['attribute_id' => $attribute2->id, 'product_id' => $product1->id, 'value' => 'Large']);
            ProductAttribute::create(['attribute_id' => $attribute3->id, 'product_id' => $product1->id, 'value' => 'کتان']);

            ProductAttribute::create(['attribute_id' => $attribute1->id, 'product_id' => $product2->id, 'value' => 'آبی']);
            ProductAttribute::create(['attribute_id' => $attribute2->id, 'product_id' => $product2->id, 'value' => 'Medium']);
            ProductAttribute::create(['attribute_id' => $attribute3->id, 'product_id' => $product2->id, 'value' => 'جین']);
        });
    }
}
