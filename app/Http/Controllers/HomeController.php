<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Ahsan\Neo4j\Facade\Cypher;

use Auth;

use App\Gene;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $display_tabs = collect([
            'active' => "home",
            'title' => "Dashboard"
        ]);

        $genes = collect();

        if (Auth::guard('api')->check())
        {
            $user = Auth::guard('api')->user();

            $genes = $user->genes;

        }

        return view('home', compact('display_tabs', 'genes'));
    }

    /**
     * Providing legacy home query a landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('error.message-standard')
        ->with('title', 'Sorry, this page has moved...')
        ->with('message', 'Please use the search or navigation bar above.')
        ->with('back', url()->previous());

    }
}
