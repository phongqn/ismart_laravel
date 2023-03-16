<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Product;
use App\Models\ProductCat;
use App\Models\Slider;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    public function index()
    {
        //lấy slider
        $list_sliders = Slider::where('status', '0')->get();
        //lấy sản phẩm nổi bật
        $outstanding_product = Product::where('outstanding_product', '0 ')->where('status', '1')->get();
        $product_selling = Product::where('product_selling', '0')->where('status', '1')->get();
        $list_ads = Ads::where('status', '0')->get();
        $catChildPhone = ProductCat::where('parent_id', function ($query) {
            $query->select('id')->from('product_cats')->where('slug', '=', 'dien-thoai');
        })->get();
        foreach ($catChildPhone as $item) {
            $catPhoneIds[] = $item->id;
        }
        // return $catPhoneIds;

        $cat_phone_list = ProductCat::whereIn('parent_id', $catPhoneIds)->get();
        foreach ($cat_phone_list as $item) {
            $list_phone_cat_id[] = $item->id;
        }
        // return $list_phone_cat_id;
        $cat_phone_list_2 = ProductCat::whereIn('parent_id', $list_phone_cat_id)->get();
        foreach ($cat_phone_list_2 as $item) {
            $cat_phone_list_3[] = $item->id;
        }
        // return $cat_phone_list_3;
        $cat_phone_list_4 = array_merge($list_phone_cat_id, $cat_phone_list_3);
        // return $cat_phone_list_4;
        $product_phone = Product::whereIn('cat_id', $cat_phone_list_4)->where('status', '=', '1')->get();
        //Laptop
        $catChildLap = ProductCat::where('parent_id', function ($query) {
            $query->select('id')->from('product_cats')->where('slug', '=', 'may-tinh');
        })->get();
        foreach ($catChildLap as $item) {
            $catLap[] = $item->id;
        }
        // return $catLap;
        $cat_lap_list = ProductCat::whereIn('parent_id', $catLap)->get();
        foreach ($cat_lap_list as $item) {
            $cat_lap_list_2[] = $item->id;
        }
        $cat_lap_all = array_merge($catLap, $cat_lap_list_2);
        $product_lap = Product::whereIn('cat_id', $cat_lap_all)->where('status', '=', '1')->get();

        //menu

        $categories = ProductCat::all();

        return view('guest.home', compact('list_sliders', 'product_selling', 'outstanding_product', 'product_phone', 'product_lap', 'list_ads', 'categories'));
    }
}
