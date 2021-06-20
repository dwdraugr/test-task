<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class WnfData extends Model
{
    use Uuid;

    public $incrementing = false;

    protected $casts = [
        'info_letter' => 'json'
    ];

    protected $primaryKey = 'id';
    protected $guarded = ['updated_at', 'created_at'];
    protected $hidden = ['updated_at', 'created_at'];
}
