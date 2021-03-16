<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\Item;
use Exception;

class ItemsApiController extends Controller
{
    public function index() {
        
        $category = request('category');
        $items = Item::all();

        try {

            if(isset($category)) {

                $cat_items = Item::where('category_id', $category)->get();
    
                if ( $cat_items->isNotEmpty()) {
    
                    return $cat_items;
                    
                }  else {
                    
                    throw new Exception('No item found in that category');

                }
                    
    
            } 

            if(!empty($items)) {
                return $items;
            } else {

                throw new Exception("No items found!");
                
            }

        }
        
        catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
                
        
    }

    public function store() {

        request()->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);


        try {

            $item = Item::create([
                'title' => request('title'),
                'price' => request('price'),
                'description' => request('description'),
                'category_id' => request('category_id'),
            ]);
    
            if($item) {

                return response()->json([
                    'item' => $item
                ], 201);

            } else {

                throw new Exception('an error occured, item could not be created');

            }
            
            
        } catch (\Throwable $th) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
       
    }

    public function show($id) {

        $item = Item::find($id);

        try {

            if ( !$item ) { 

                throw new ModelNotFoundException('item not found');

            } 

            return [
                'id' => $item->id,
                'title' => $item->title,
                'price' => $item->price,
                'description' => $item->description,
                'category' => $item->category->name,
                'date_created' => $item->created_at
            ];

        } catch (\Throwable $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 404);
            
        }
        

    }

    public function update($id) {

        request()->validate([ 
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);


        try {

            $item = Item::find($id);

            if (!$item) {

                throw new Exception('error on update, cannot find item with id='.$id);
            }
            
            $success = $item->update([
                'title' => request('title'),
                'price' => request('price'),
                'description' => request('description'),
                'category_id' => request('category_id'),
            ]);

    
            

            return [
                'updated' => $success,
                'updated_item' => Item::find($item)
            ];

        } catch (\Throwable $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 400);
           
        }
        
    }

    public function destroy($id) {

        try {
 
            $item = Item::find($id);

            if (!$item) {

                throw new Exception('error on delete, cannot find item with id='.$id);

            }

            $success = $item->delete();
    
            if( $success ) { 
                return response()->json([
                    'deleted' => $success
                    ], 200);
            } else {
                throw new Exception("Error Processing Request", 1);
                
            }
        
        } catch (\Exception $e) {
            return response()->json([
            'error' => $e->getMessage()
            ], 500);
        }
     }
}
