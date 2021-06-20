<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WnfData extends Model
{
    use HasFactory;

    protected $casts = [
        'info_letter' => 'json'
    ];

    protected $guarded = ['updated_at', 'created_at'];
}
