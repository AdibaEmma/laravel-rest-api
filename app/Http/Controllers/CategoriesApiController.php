<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesApiController extends Controller
{
    public function index() {

        return Category::all();
        
    }
}
