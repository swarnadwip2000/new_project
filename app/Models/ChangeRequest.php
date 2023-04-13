<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    use HasFactory;

    public function stuff()
    {
        return $this->belongsTo(User::class, 'stuff_id');
    }
}
