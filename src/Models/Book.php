<?php

namespace VienNguyen113\BookCRUD\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author'];
}
