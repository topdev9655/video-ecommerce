<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Wallet;
use App\Movie;
use App\Language;
use App\Category;
use App\Genre;

class PageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movies = Movie::all();
        $languages = Language::all();

        return view('home', ['movies' => $movies, 'languages' => $languages]);
    }

    public function profile()
    {
        $wallet = Wallet::where('user_id', '=', Auth::user()->id)->get();
        
        if ($wallet->count() < 1) {
            $wallet = [
                '0' => [
                    'wallet' => 0
                ]
            ];
        }

        return view('profile', ['wallet' => $wallet]);
    }

    public function movies($filter = '')
    {
        if ($filter) {
            $filterr = json_decode($filter);
            
            $movies = Movie::query();

            foreach ($filterr->genre as $g) {
                $movies = $movies->orWhere('genres', 'like', '%' . $g . '%');
            }

            foreach ($filterr->language as $l) {
                $movies = $movies->orWhere('language', 'like', '%' . $l . '%');
            }

            foreach ($filterr->category as $c) {
                $movies = $movies->orWhere('category', 'like', '%' . $c . '%');
            }

            $movies = $movies->get();
        } else {
            $movies = Movie::all();
        }

        $languages = Language::all();
        $categories = Category::all();
        $genres = Genre::all();

        return view('movies', ['filter' => json_decode($filter), 'movies' => $movies, 'languages' => $languages, 'categories' => $categories, 'genres' => $genres]);
    }

    public function movieDetail($id)
    {
        $movie = Movie::find($id);
        
        $languages = Language::all();
        $categories = Category::all();
        $genres = Genre::all();

        return view('movieDetail', ['movie' => $movie, 'languages' => $languages, 'categories' => $categories, 'genres' => $genres]);
    }

    public function watchMovie($id)
    {
        $movies = Movie::where('id', '!=', $id)->get();
        $movie = Movie::find($id);
        
        $languages = Language::all();
        $categories = Category::all();
        $genres = Genre::all();

        return view('watchMovie', ['movie' => $movie, 'movies' => $movies, 'languages' => $languages, 'categories' => $categories, 'genres' => $genres]);
    }

    public function searchMovie($keyword, $filter = '')
    {
        if ($filter) {
            $filterr = json_decode($filter);
            
            $movies = Movie::query();

            foreach ($filterr->genre as $g) {
                $movies = $movies->orWhere('genres', 'like', '%' . $g . '%');
            }

            foreach ($filterr->language as $l) {
                $movies = $movies->orWhere('language', 'like', '%' . $l . '%');
            }

            foreach ($filterr->category as $c) {
                $movies = $movies->orWhere('category', 'like', '%' . $c . '%');
            }

            $movies = $movies->where('title', 'like', '%' . $keyword . '%');

            $movies = $movies->get();
        } else {
            $movies = Movie::where('title', 'like', '%' . $keyword . '%')->get();
        }

        $languages = Language::all();
        $categories = Category::all();
        $genres = Genre::all();
        
        return view('searchMovies', ['filter' => json_decode($filter), 'keyword' => $keyword, 'movies' => $movies, 'languages' => $languages, 'categories' => $categories, 'genres' => $genres]);
    }

    // public function video()
    // {
    //     $userWallet = Wallet::where('user_id', '=', Auth::user()->id)->get();

    //     if ($userWallet->count() < 1) {
    //         $userWallet = [
    //             '0' => [
    //                 'wallet' => 0
    //             ]
    //         ];
    //     }

    //     return view('video', ['userWallet' => $userWallet]);
    // }
}
