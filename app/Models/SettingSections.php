<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingSections extends Model
{
    protected $table = 'setting_sections';

    protected $fillable = [
        'name',
        'is_active',
    ];
}
