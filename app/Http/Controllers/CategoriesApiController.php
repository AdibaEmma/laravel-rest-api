<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesApiController extends Controller
{
    public function index() {
        try {
            $categories = Category::all();

            if(empty($categories)) {
                throw new ModelNotFoundException("category list empty", 1);
            }

            return $categories;


        } catch (\Throwable $th) {
            
        }
        
        
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
