<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donatur extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'nomer_hp', 'fundraising_id', 'total_donasi', 'notes', 'bukti', 'sudah_bayar',
    ];
}
