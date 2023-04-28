<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Genre2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.genres2.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/genres2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:genres,name'
        ]);

        // Create new genre
        $genre = new Genre();
        $genre->name = $request->name;
        $genre->save();

        // Return a success message to master page
        return response()->json([
            'type' => 'success',
            'text' => "The genre <b>$genre->name</b> has been added"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return redirect('admin/genres2');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return redirect('admin/genres2');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:genres,name,' . $genre->id
        ]);

        // Update genre
        $genre->name = $request->name;
        $genre->save();

        // Return a success message to master page
        return response()->json([
            'type' => 'success',
            'text' => "The genre <b>$genre->name</b> has been updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->json([
            'type' => 'success',
            'text' => "The genre <b>$genre->name</b> has been deleted"
        ]);
    }

    public function qryGenres()
    {
        $genres = Genre::orderBy('name')
            ->withCount('records')
            ->get();
        return $genres;
    }

}
