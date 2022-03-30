<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    public function index(){
        // $menu = Menu::get();
        //UNGGULAN
        $makanan_rate = DB::table('menus')->join('categories', 'menus.id_category', '=', 'categories.id_category')
                                    ->select('menus.*', 'categories.type' )
                                    ->where('menus.id_category', '=', '1')
                                    ->get();
        $sort_makan = $makanan_rate->SortByDesc('rating')->first();

        $minuman_rate = DB::table('menus')->join('categories', 'menus.id_category', '=', 'categories.id_category')
                                      ->select('menus.*', 'categories.type' )
                                      ->where('menus.id_category', '=', '2')
                                      ->get();
        $sort_minum = $minuman_rate->SortByDesc('rating')->first();  

        $snack_rate = DB::table('menus')->join('categories', 'menus.id_category', '=', 'categories.id_category')
                                      ->select('menus.*', 'categories.type' )
                                      ->where('menus.id_category', '=', '3')
                                      ->get();
        $sort_snack = $snack_rate->SortByDesc('rating')->first();

        return response()->json([
            $sort_makan,
            $sort_minum,
            $sort_snack,
        ]);
    }

    public function makanan(){
        $makanan = DB::table('menus')->join('categories', 'menus.id_category', '=', 'categories.id_category')
                                      ->select('menus.*', 'categories.type' )
                                      ->where('menus.id_category', '=', '1')
                                      ->get();
        return response()->json($makanan);
    }
    public function minuman(){
        $minuman = DB::table('menus')->join('categories', 'menus.id_category', '=', 'categories.id_category')
                                      ->select('menus.*', 'categories.type' )
                                      ->where('menus.id_category', '=', '2')
                                      ->get();
        return response()->json($minuman);

    }
    public function snack(){
        $snack = DB::table('menus')->join('categories', 'menus.id_category', '=', 'categories.id_category')
                                      ->select('menus.*', 'categories.type' )
                                      ->where('menus.id_category', '=', '3')
                                      ->get();
        return response()->json($snack);
    }
    public function unggulanMakan(){
        $makanan_rate = DB::table('menus')->join('categories', 'menus.id_category', '=', 'categories.id_category')
                                    ->select('menus.*', 'categories.type' )
                                    ->where('menus.id_category', '=', '1')
                                    ->get();
        $sort_makan = $makanan_rate->SortByDesc('rating')->first();  

        return response()->json($sort_makan);
    }
    public function unggulanMinum(){
        $makanan_rate = DB::table('menus')->join('categories', 'menus.id_category', '=', 'categories.id_category')
                                    ->select('menus.*', 'categories.type' )
                                    ->where('menus.id_category', '=', '2')
                                    ->get();
        $sort_makan = $makanan_rate->SortByDesc('rating')->first();  

        return response()->json($sort_makan);
    }
    public function unggulanSnack(){
        $makanan_rate = DB::table('menus')->join('categories', 'menus.id_category', '=', 'categories.id_category')
                                    ->select('menus.*', 'categories.type' )
                                    ->where('menus.id_category', '=', '3')
                                    ->get();
        $sort_makan = $makanan_rate->SortByDesc('rating')->first();  

        return response()->json($sort_makan);
    }
}
