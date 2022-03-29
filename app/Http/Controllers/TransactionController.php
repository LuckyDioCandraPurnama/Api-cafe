<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_menu' => 'required',
            'table' => 'required',
            'payment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $store = new Transaction();
        $store->id_menu = $request->id_menu;
        $store->table = $request->table;
        $store->payment = $request->payment;

        //GET HARGA MENU
        $menu = Menu::where('id_menu', '=', $store->id_menu)->first();
        $price = $menu->price;

        $store->quantity = $request->quantity;
        $store->subtotal = $store->quantity * $price;

        $store->save();

        $data = DetailTransaksi::where('id_detail_transaksi', '=', $store->id_detail_transaksi)->first();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Tambah Detail Transaksi',
            'data' => $data
        ]);
    }
}
