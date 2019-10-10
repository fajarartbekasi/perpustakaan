<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $guarded = [];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

}
