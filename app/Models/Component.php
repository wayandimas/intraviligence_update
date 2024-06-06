<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Component extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $tables = 'components';
    protected $fillable = [
        'nama',
        'categori_id',
        'alias'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

     public function kategori()
    {
        return $this->belongsTo(Category::class,'categori_id');
    }


}
