<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table' => 'required',
            'payment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $store = new Transaction();
        $store->table = $request->table;
        $store->payment = $request->payment;
        $store->date = Carbon::now();
        $store->status = 'new';

        $store->save();

        $data = Transaction::where('id_transaction', '=', $store->id_transaction)->first();

        return response()->json([
            'success' => true,
            'message' => 'Add Data Transaction Success',
            'data' => $data
        ]);
    }
    public function bayar($id)
    {
        $transaksi = Transaction::where('id_transaction', '=', $id)->first();
        $total = TransactionDetail::where('id_detail', $id)->sum('subtotal');

        $transaksi->status = "away";
        $transaksi->total = $total;        
        
        $transaksi->save();
        
        return response()->json(['message' => 'Pembayaran berhasil']);
    }
}
