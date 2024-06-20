<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RentLogs extends Model
{
    use HasFactory;

    protected $table = 'rentlogs';

    protected $fillable = [
        'user_id',
        'book_id', 'rent_date', 'return_date'
    ];
}