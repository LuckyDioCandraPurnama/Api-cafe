<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TransactionDetail;
use App\Models\Menu;

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
        $store->id_transaction = $request->id_transaction;
        $store->id_menu = $request->id_menu;

        //GET MENU PRICE
        $menu = Menu::where('id_menu', '=', $store->id_menu)->first();
        $price = $menu->price;

        $store->quantity = $request->quantity;
        $store->subtotal = $store->quantity * $price;

        $store->save();

        $data = TransactionDetail::where('id_transaction', '=', $store->id_transaction)->first();

        return response()->json([
            'success' => true,
            'message' => 'Add Data Success',
            'data' => $data
        ]);
    }
}
