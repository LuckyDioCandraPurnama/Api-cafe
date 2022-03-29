<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaction';
    protected $table = 'transactions';

    protected $fillable = ['id_menu', 'table', 'date', 'status', 'payment'];
}
