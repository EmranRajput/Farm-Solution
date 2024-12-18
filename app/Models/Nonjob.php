<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nonjob extends Model
{
    use HasFactory;
    protected $table = 'nonlaborjob';
    protected $fillable = ['name', 'subcategory', 'status'];

    public $timestamps = false; 
}
