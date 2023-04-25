<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'user_id',
        'balance',
        'currency'
    ];
    protected $hidden = [

        'created_at',
        'updated_at',
    ];
}
