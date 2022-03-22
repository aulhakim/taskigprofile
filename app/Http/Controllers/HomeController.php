<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function postMedia(Request $request)
    {
       $success =  Media::create([
            'picture_link' =>  $request->link_image,
            'description' =>  $request->description,
        ]);

        return $success;

    }
}
