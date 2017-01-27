<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * [getIndex description]
     * @return [type] [description]
     */
    public function getIndex()
    {
      $books = Book::all();

      return view('books.books_list', compact('books'));
    }
}
