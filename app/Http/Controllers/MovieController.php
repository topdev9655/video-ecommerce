<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Movie;
use App\Language;
use App\Category;
use App\Genre;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        $categories = Category::all();
        $genres = Genre::all();

        return view('movie/movie', ['movies' => $movies, 'categories' => $categories, 'genres' => $genres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        $categories = Category::all();
        $genres = Genre::all();

        return view('movie/add', ['languages' => $languages, 'categories' => $categories, 'genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'release_date' => 'required',
            'region' => 'required',
            'language' => 'required',
            'category' => 'required',
            'genres' => 'required',
            'directors' => 'required',
            'writers' => 'required',
            'cast' => 'required',
            'plot' => 'required',
            'summary' => 'required',
            'movie_link' => 'required',
            'duration_hour' => 'required',
            'duration_min' => 'required',
        ]);

        $movie = new Movie;
        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->release_date = $request->release_date;
        $movie->duration = $request->duration_hour.':'.$request->duration_min;
        $movie->region = $request->region;
        $movie->language = $request->language;
        $movie->category = implode(',', $request->category);
        $movie->genres = implode(',', $request->genres);
        $movie->directors = implode(',', $request->directors);
        $movie->writers = implode(',', $request->writers);
        $movie->cast = implode(',', $request->cast);
        if ($request->poster) {
            $poster = $request->file('poster')->store('movie_poster');
            $movie->poster = $poster;
        } else {
            $movie->poster = $request->poster;
        }
        $movie->poster_link = $request->poster_link;
        if ($request->cover) {
            $cover = $request->file('cover')->store('movie_cover');
            $movie->cover = $cover;
        } else {
            $movie->cover = $request->cover;
        }
        $movie->cover_link = $request->cover_link;
        $movie->plot = $request->plot;
        $movie->summary = $request->summary;
        $movie->movie_link = $request->movie_link;

        $movie->save();
        
        return redirect()->route('movie.index')->with('message', 'New movie create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        $languages = Language::all();
        $categories = Category::all();
        $genres = Genre::all();

        return view('movie/detail', ['movie' => $movie, 'languages' => $languages, 'categories' => $categories, 'genres' => $genres]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        $languages = Language::all();
        $categories = Category::all();
        $genres = Genre::all();

        return view('movie/edit', ['movie' => $movie, 'languages' => $languages, 'categories' => $categories, 'genres' => $genres]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'release_date' => 'required',
            'region' => 'required',
            'language' => 'required',
            'category' => 'required',
            'genres' => 'required',
            'directors' => 'required',
            'writers' => 'required',
            'cast' => 'required',
            'plot' => 'required',
            'summary' => 'required',
            'movie_link' => 'required',
            'duration_hour' => 'required',
            'duration_min' => 'required',
        ]);

        $movie = Movie::find($id);

        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->release_date = $request->release_date;
        $movie->duration = $request->duration_hour.':'.$request->duration_min;
        $movie->region = $request->region;
        $movie->language = $request->language;
        $movie->category = implode(',', $request->category);
        $movie->genres = implode(',', $request->genres);
        $movie->directors = implode(',', $request->directors);
        $movie->writers = implode(',', $request->writers);
        $movie->cast = implode(',', $request->cast);
        if ($request->poster) {
            Storage::delete($movie->poster);
            $poster = $request->file('poster')->store('movie_poster');
            $movie->poster = $poster;
        } else {
            $movie->poster = $movie->poster;
        }
        $movie->poster_link = $request->poster_link;
        if ($request->cover) {
            Storage::delete($movie->cover);
            $cover = $request->file('cover')->store('movie_cover');
            $movie->cover = $cover;
        } else {
            $movie->cover = $movie->cover;
        }
        $movie->cover_link = $request->cover_link;
        $movie->plot = $request->plot;
        $movie->summary = $request->summary;
        $movie->movie_link = $request->movie_link;

        $movie->save();
        
        return redirect()->route('movie.index')->with('message', 'Movie update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Movie::destroy($id);
        
        return redirect()->back()->with('message', 'Movie delete successfully');
    }
}
