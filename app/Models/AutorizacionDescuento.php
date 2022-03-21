<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutorizacionDescuento extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // hasOne User
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
