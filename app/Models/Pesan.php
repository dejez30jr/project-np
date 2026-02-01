<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesan extends Model
{
    use HasFactory;
    protected $table = 'pesans';
    protected $fillable = [
        'name',
        'email',
        'message',
        'is_read',
    ];
}
