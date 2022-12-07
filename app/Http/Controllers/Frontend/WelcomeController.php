<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index (){
        $specials = Category::where('name', 'Specials')->first();

        return view('welcome', compact('specials'));
    }
}
