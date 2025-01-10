<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundraisers extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_active', 'users_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    
    public function fundraising(){
        return $this->hasMany(Fundraising::class, 'fundraisers_id');
    }
}
