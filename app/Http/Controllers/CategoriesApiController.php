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

    public function show(Category $category) {

        return $category;

    }

    public function update(Category $category) {
        request()->validate([
            'name' => 'required',
        ]);


        $success = $category->update([
            'name' => request('name'),
        ]);

        return [
            'updated' => $success,
            'updated_category' => Category::find($category)
        ];
    }

    public function destroy(category $category) {

        $success = $category->delete();

        return [
            'deleted' => $success
        ];
    }
}
