<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $connection = 'web';

    protected $fillable = [
        'key',
        'value',
    ];
}
