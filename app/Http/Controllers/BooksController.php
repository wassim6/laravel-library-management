<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Book;
use App\Http\Requests\AddBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$books = Book::with('category')->get();
        /*
        $books = Book::with(['category' => function($query){
            $query->select('name');
        }])->get();
        */
        /*
        $books = Book::get();
        $books->load('category');
        return view('books.index', compact('books'));
        */
        //Travail Mr
        $title = "Books";
        $books = Book::with('category')->orderBy('id', 'DESC')->paginate(10);
        return view('books.index', compact('title', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Book";
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBookRequest $request)
    {
        $data = $request->except('_token');
        $data['slug'] = Str::slug($data['name']);
        //dd($data);
        Book::create($data);
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Show Book";
        $book = Book::find($id);
        if(!$book) return redirect()->route('posts.index');
        $categories = Category::orderBy('name')->get();
        return view('books.show', compact('book', 'title', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Book";
        $book = Book::find($id);
        if(!$book) return redirect()->route('posts.edit');
        $categories = Category::orderBy('name')->get();
        //dd($book);
        return view('books.edit', compact('title', 'book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $data['slug'] = Str::slug($data['name']);
        Book::where('id', $id)->update($data);
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect()->route('books.index');

    }


    public function home()
    {
        $title = "Welcome";
        $books = Book::with('category')->orderBy('id', 'DESC')->paginate(10);
        /*
            //dd(Session::all());
            Session::put('cle', 'valeur');
            Session::put('obj.a', 'valeur a');
            Session::push('cle','val');
            Session::all();
            Session::has('cle');//return true si il existe
            Session::get('obj.a');
            session('cle');
        */
        $fav = Session::all();
        return view('books.home', compact('title', 'books', 'fav'));
    }

    public function addToFavorite($id)
    {
        $favorites = Session::get('fav');
        if ($favorites==null) {
            Session::push('fav', $id);
        }
        else if(!in_array($id, $favorites)){
            Session::push('fav', $id);
        }
        return redirect()->route('home');

    }

    public function myFavorite(){
        $title="My favorites Books";
        $favorites = Session::get('fav');
        $tab = array();
        foreach ($favorites as $f){
            array_push($tab, $f);
        };
        $books=Book::whereIn('id', $tab)->get();
        return view('books.favorite', compact('title', 'books'));
    }

    public function removeFavorite($id)
    {
        $favorites = Session::get('fav');
        if(($key = array_search($id, $favorites)) !== false) {
            unset($favorites[$key]);
            Session::put('fav', $favorites);
        }
        return redirect()->route('myfavorite');
    }

}
