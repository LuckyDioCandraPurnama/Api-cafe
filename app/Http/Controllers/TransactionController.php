<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;
use App\Models\Transaction;
use Carbon\Carbon;

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
        $store->date = Carbon::now();
        $store->status = 'new';

        //GET MENU PRICE
        $menu = Menu::where('id_menu', '=', $store->id_menu)->first();
        $price = $menu->price;

        $store->quantity = $request->quantity;
        $store->subtotal = $store->quantity * $price;

        $store->save();

        $data = Transaction::where('id_transaction', '=', $store->id_transaction)->first();

        return response()->json([
            'success' => true,
            'message' => 'Add Data Transaction Success',
            'data' => $data
        ]);
    }
}
