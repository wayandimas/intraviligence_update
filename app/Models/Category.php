<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'operasional_id'

    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

     


     public function operasional()
    {
        return $this->belongsTo(Operasional::class, 'operasional_id');
    }

}

