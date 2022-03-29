<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail';
    protected $table = 'transaction_details';

    protected $fillable = ['id_transaction', 'id_menu', 'quantity', 'subtotal'];
}
