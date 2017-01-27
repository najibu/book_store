<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{ 
    /**
     * [$guarded description]
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * [books description]
     * @return [type] [description]
     */
    public function books()
    {
      return $this->belongsTo('Book', 'book_id');
    }
}
