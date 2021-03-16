<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoriesApiController extends Controller
{
    public function index() {
        try {
            $categories = Category::all();

            if(empty($categories)) {

                throw new Exception("category list empty", 1);
            }

            return $categories;


        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
                ],400);
        }
        
        
    }

    public function store() {

        request()->validate([
            'name' => 'required',
        ]);

        $category = Category::create([
            'name' => request('name'),
        ]);

        if(!$category) {

            throw new Exception('an error occured, category could not be created');

        } 
        
        return response()->json([
            'category' => $category
        ], 201);
    
    }

    public function show($id) {

        $category = Category::find($id);

        try {

            if ( !$category ) { 

                throw new Exception('category not found');

            } 

            return response()->json([
                'category' => $category
            ], 200);

        } catch (\Throwable $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 404);
            
        }

    }

    public function update($id) {
        request()->validate([
            'name' => 'required',
        ]);


        try {

            $category = Category::find($id);

            if (!$category) {

                throw new Exception('error on update, cannot find category with id='.$id);
            }
            
            $success = $category->update([
                'name' => request('name'),
            ]);

            return [
                'updated' => $success,
                'updated_category' => Category::find($id)
            ];

        } catch (\Throwable $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 400);
           
        }
       
    }

    public function destroy($id) {

       try {
 
            $category = Category::find($id);

            if (!$category) {

                throw new Exception('error on delete, cannot find category with id='.$id, 1);

            }

            $success = $category->delete();
    
            if( $success ) { 
                return response()->json([
                    'deleted' => $success
                    ], 200);
            } else {
                throw new Exception("Error Processing Request", 500);
                
            }
        
        } catch (\Exception $e) {
            return response()->json([
            'error' => $e->getMessage()
            ],400);
        }
     }

}
