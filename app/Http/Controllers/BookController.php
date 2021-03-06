<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Validator;
use PDF;
use Auth;

class BookController extends Controller
{
    //be login negalima prieti prie create/read/update/deleate
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authors = Author::all();
        // sortinimas
        if ($request->author_id) {
            if ($request->sort && 'asc' == $request->sort) {
                // $books = Book::where('author_id', $request->author_id)->orderBy('title')->paginate(3);
                $books = Book::where('author_id', $request->author_id)->orderBy('title')->get();
                $sortBy = 'asc';
                $books->appends(['author_id' => $request->author_id, 'sort' => 'asc']);
            } else if($request->sort && 'desc' == $request->sort) {
                // $books = Book::where('author_id', $request->author_id)->orderBy('title', 'desc')->paginate(3);
                $books = Book::where('author_id', $request->author_id)->orderBy('title', 'desc')->get();
                $sortBy = 'desc';
                $books->appends(['author_id' => $request->author_id, 'sort' => 'desc']);
            } else {
                // $books = Book::where('author_id', $request->author_id)->paginate(3);
                $books = Book::where('author_id', $request->author_id)->get();
            }
            $filterBy = $request->author_id;
        }
        else {
            if ($request->sort && 'asc' == $request->sort) {
                // $books = Book::orderBy('title')->paginate(3);
                $books = Book::orderBy('title')->get();
                $books->appends(['sort' => 'asc']);
                $sortBy = 'asc';
            } else if($request->sort && 'desc' == $request->sort) {
                // $books = Book::orderBy('title', 'desc')->paginate(3);
                $books = Book::orderBy('title', 'desc')->get();
                $books->appends(['sort' => 'desc']);
                $sortBy = 'desc';
            } else {
                // $books = Book::paginate(3);
                $books = Book::get();
            }
        }

        return view('book.index', [
        'books' => $books,
        'authors' => $authors,
        'filterBy' => $filterBy ?? 0,
        'sortBy' => $sortBy ?? ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role) {
            $authors = Author::all();
            $publishers = Publisher::all();
            return view('book.create', ['authors' => $authors, 'publishers' => $publishers]);
        } else {
            abort(403, 'You do not have persmision to create a book.');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->role) {
            $validator = Validator::make($request->all(),
                [
                    'book_title' => ['required', 'min:3', 'max:64'],
                    'book_isbn' => ['required', 'min:3', 'max:64'],
                    'book_pages' => ['required', 'min:3', 'max:64'],
                    'book_about' => ['required', 'min:3',],
                ]
            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

            $book = new Book;
            $book->title = $request->book_title;
            $book->isbn = $request->book_isbn;
            $book->pages = $request->book_pages;
            $book->about = $request->book_about;
            $book->author_id = $request->author_id;
            $book->publisher_id = $request->publisher_id;
            $book->save();
            return redirect()->route('book.index')->
            with('info_message', 'Book has been successfully created!');
        } else {
            return redirect()->route('book.index')->with('info_message', 'You do not have permisiion to create a book!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors, 'publishers' => $publishers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(),
        [
            'book_title' => ['required', 'min:3', 'max:64'],
            'book_isbn' => ['required', 'min:3', 'max:64'],
            'book_pages' => ['required', 'min:3', 'max:64'],
            'book_about' => ['required', 'min:3',],
        ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()->route('book.index')->
        with('info_message', 'Book has been successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->
        with('info_message', 'Book has been successfully deleted!');
    }

    public function pdf(Book $book)
    {
        $pdf = PDF::loadView('book.pdf', ['book' => $book]); // standartinis view
        return $pdf->download('book-id'.$book->id.'.pdf'); // pdf failo pavadinimas
    }

}
