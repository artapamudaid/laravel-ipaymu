<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'trxId',
        'referenceId',
        'via',
        'channel',
        'va',
        'nominal',
        'admin_fee',
        'expired',
    ];
}
