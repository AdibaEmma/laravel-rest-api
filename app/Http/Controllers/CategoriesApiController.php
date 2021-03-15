<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesApiController extends Controller
{
    public function index() {

        return Category::all();
        
    }

    public function store() {

        request()->validate([
            'name' => 'required',
        ]);


        $categories = Category::create([
            'name' => request('name'),
        ]);

        return $categories;
    }
}
