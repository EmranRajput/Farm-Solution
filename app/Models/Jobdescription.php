<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobdescription extends Model
{
    use HasFactory;
    protected $table = 'jobdescription';
    protected $fillable = ['name', 'subcategory', 'status'];

    public $timestamps = true;

}
