<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expensesheet';
    protected $fillable = ['user_id','ranch_id','variety', 'block_id','acre_id'];

    public $timestamps = true;


    public function ranch(){
        return $this->belongsTo(Ranch::class, 'ranch_id','id');
    }
    
    public function block(){
        return $this->belongsTo(Block::class, 'block_id','id');
    }

    public function acres(){
        return $this->belongsTo(Acre::class, 'acre_id','id');
    }
}
