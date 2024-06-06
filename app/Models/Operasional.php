<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operasional extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

     public function user()
    {
        return $this->hasMany(User::class,'operasional_id');
    }

      public function officer()
    {
        return $this->hasMany(Officer::class,'operasional_id');
    }

      public function categori()
    {
        return $this->hasMany(Categori::class,'operasional_id');
    }


}
