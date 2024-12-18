<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class crew_boss extends Model
{
    use HasFactory;
    protected $table = 'crew_boss';
    protected $fillable = [
        'crew_id',
        'boss_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
