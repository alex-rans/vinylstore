<?php

namespace App\Http\Controllers;

use App\Record;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;

class ItunesController extends Controller
{
    public function index()
    {
        $response = Http::get("https://rss.applemarketingtools.com/api/v2/be/music/most-played/12/songs.json")->json();
        $response = $response['feed'];
        $title = $response['title'] . ' - ' . strtoupper($response['country']);
        $update = $response['updated'];
        $update = Carbon::parse($update)->format('l j F');
        $songs = $response['results'];
        $songs = collect($songs);
//        dd($records);
        $result = compact('songs', 'title', 'update');
        return view('itunes', $result);
    }
}
