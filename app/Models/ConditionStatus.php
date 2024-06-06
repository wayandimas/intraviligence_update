<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionStatus extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = "condition_status";
    protected $fillable = [
        'status',
        'kondisi'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    

}
