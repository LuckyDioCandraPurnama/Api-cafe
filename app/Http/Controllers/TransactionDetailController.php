<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TransactionDetail;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;


class TransactionDetailController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaction' => 'required',
            'id_menu' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $store = new TransactionDetail();
        $store->id_transaction = '1';
        $store->id_menu = $request->id_menu;

        //GET MENU PRICE
        $menu = Menu::where('id_menu', '=', $store->id_menu)->first();
        $price = $menu->price;

        $store->quantity = $request->quantity;
        $store->subtotal = $store->quantity * $price;

        $store->save();

        $data = TransactionDetail::where('id_transaction', '=', $store->id_transaction)->first();

        return response()->json($data);
    }
    public function getTotal($id)
    {
        $total = TransactionDetail::where('id_transaction', $id)->sum('subtotal');
        
        return response()->json([
            'total' => $total
        ]);
    }

    // public function getAll()
    // {
    //     $data = DB::table('transaction_details')->join('menus', 'transaction_details.id_menu', '=', 'menus.id_menu')      
    //                                   ->select('transaction_details.*', 'menus.name', 'menus.price')
    //                                   ->where('transaction_details.id_transaction', '=', '1')
    //                                   ->get();
    //     return response()->json($data);
    // }
    
    public function getById()
    {
        // $data = TransactionDetail::where('id', '=', '1')->first();  
        $data = DB::table('transaction_details')->join('menus', 'transaction_details.id_menu', '=', 'menus.id_menu')      
                                      ->select('transaction_details.*', 'menus.name', 'menus.price')
                                      ->where('transaction_details.id_transaction', '=', '1')
                                      ->get();
        return response()->json($data);
    }
}
