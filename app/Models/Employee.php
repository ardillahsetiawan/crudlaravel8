<?php

namespace App\Models;

use App\Models\Religion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['created_at', 'tanggal_lahir'];

    public function religions()
    {
        return $this->belongsTo(Religion::class, 'id_religions', 'id');
    }
}
