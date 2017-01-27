<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  /**
   * [$guarded description]
   * @var array
   */
  protected $guarded = ['id'];

  /**
   * [orderItems description]
   * @return [type] [description]
   */
  public function orderItems()
  {
    return $this->belongsToMany(Book::class)->withPivot('amount', 'total');
  }
}
