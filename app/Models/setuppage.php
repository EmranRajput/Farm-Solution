<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setuppage extends Model
{
    use HasFactory;
    protected $table = 'setup_labor';
    protected $fillable = [
        'id', // Add 'id' to the fillable array
        'name',
        'ranch_id',
        'block_id',
        'commodity',
        'variety',
        'acres',
        'rows',
        'row_spacing',
        'tree_spacing',
        'pollinator',
        'pollinator_spacing',
        'trees_row',
        'trees_acre',
        'status',
    ];

    public $timestamps = true;


    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id', 'id');
    }

    public function ranch()
    {
        return $this->belongsTo(Ranch::class, 'ranch_id', 'id');
    }

    public function username()
    {
        return $this->belongsTo(User::class, 'name', 'id');
    }
}
