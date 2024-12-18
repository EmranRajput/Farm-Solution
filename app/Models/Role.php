<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'users_role';
    protected $fillable = ['name', 'role', 'status'];

    public $timestamps = false; 


    public function user()
    {
        return $this->hasOne(User::class, 'role');
    }

}
