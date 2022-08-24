<?php

namespace App\Http\Controllers;

use App\Book;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->with('user')
            ->orderByRaw('user_id is null')
            ->orderBy('name')
            ->paginate();

        return view('books', ['books' => $books]);
    }
}
