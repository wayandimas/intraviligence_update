<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
      public function index()
    {

        $categories = Category::where('operasional_id', 1)->get();
        return view('pages.patroli.index')->with('categories', $categories);


    }
}
