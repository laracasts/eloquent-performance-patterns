<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->orderBy(User::select('name')
                ->join('checkouts', 'checkouts.user_id', '=', 'users.id')
                ->whereColumn('checkouts.book_id', 'books.id')
                ->latest('checkouts.borrowed_date')
                ->take(1)
            )
            ->withLastCheckout()
            ->with('lastCheckout.user')
            ->paginate();

        return view('books', ['books' => $books]);
    }
}
