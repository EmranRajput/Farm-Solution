<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'laborentry_details';
    protected $fillable = ['client_id', 'date','crew_boss', 'invoice_category', 'invoice', 'company', 'people', 'ranch_id', 'block_id', 'acre_id', 'description', 'jobdescription', 'total_amount', 'full_time', 'comission', 'crewboss_amount','status'];

    public $timestamps = true;

    public function crewuser(){
        return $this->belongsTo(Nonjob::class, 'description','id');
    }

    public function clientuser(){
        return $this->belongsTo(User::class, 'client_id','id');
    }
    
    public function ranchuser(){
        return $this->belongsTo(Ranch::class, 'ranch_id','id');
    }
    
    public function blockuser(){
        return $this->belongsTo(Block::class, 'block_id','id');
    }

    public function jobuser(){
        return $this->belongsTo(Nonjob::class, 'description','id');
    }

}
