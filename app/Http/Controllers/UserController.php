<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use App\Models\Film;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function store(Request $request)
    {    
        $body = $request->all();
        var_dump($body["externalId"]);die();
        $user = User::find(Auth::user()->id);
        $isFilmAlreadySaved = $user->films()->where('externalId', $body["externalId"])->first();
        if ($isFilmAlreadySaved) {
            if ($body->toWatch == 1 && $isFilmAlreadySaved->toWatch == 0) {
                $isFilmAlreadySaved->toWatch = 1;
                $isFilmAlreadySaved->toWatch = 1;
                $isFilmAlreadySaved->save();
            } else if ($body->watched == 1 && $isFilmAlreadySaved->watched == 0) {
                $isFilmAlreadySaved->toWatch = 0;
                $isFilmAlreadySaved->watched = 1;
                $isFilmAlreadySaved->save();
            }
            return response()->json(['error' => 'case to complete'], 200);
        }

        $filmToWatch = new Film($body);
        $filmToWatch->userId = $user->id;
        
        $filmToWatch->save();
        
        return response()->json([
            'status' => 'success',
            'data' => $filmToWatch
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show all movies and series saved in myList.
     *
     * @return \Illuminate\Http\Response
     */
    public function myList()
    {
        $user = User::find(Auth::user()->id);
        $myList = $user->films()->where('toWatch', 1)->get();

        /* foreach ($myList as $film) {
            var_dump($film);
        } */
        return response()->json([
            'success' => true,
            'data' => $myList,
        ]);

    }

    /**
     * Show all movies and series watched yet.
     *
     * @return \Illuminate\Http\Response
     */
    public function myWatchedList()
    {
        $user = User::find(Auth::user()->id);
        $myWatchedList = $user->films()->where('watched', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $myWatchedList,
        ]);

    }
    
}
