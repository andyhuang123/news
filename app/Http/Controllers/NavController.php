<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorynew;

class NavController extends Controller
{
    public function index()
    {
        $categories = Categorynew::with(['children' => function ($query) {
            $query->orderBy('order');
        }, 'sites'])
            ->withCount('children')
            ->orderBy('order')
            ->get();
      

        return view('nav.index')->with('categories', $categories);
    }

    
}
