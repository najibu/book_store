<?php

namespace App;

use App\Author;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];

    public function author()
    {
      return $this->belongsTo(Author::class);
    }
}
