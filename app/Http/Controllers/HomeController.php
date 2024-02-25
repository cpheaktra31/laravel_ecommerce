<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

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
        $menu = Menu::all();
        return view('home', compact('menu'));
    }

    public function getUrl($menu_type, $slug) {
        $menu = Menu::where('slug_en', $slug)->first();
        if(!$menu) {
            return;
        }
        switch ($menu_type) {
            case 'category':
                return view('test.category', compact('menu'));
            case 'sigle-page':
                return view('test.single-page', compact('menu'));
            default:
                return view('home');
        }
    }
}
