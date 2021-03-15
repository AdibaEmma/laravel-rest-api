<?php

namespace App\Http\Controllers;

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

        try {

            if(isset($category)) {

                $items = Item::where('category_id', $category)->get();
    
                if ( $items->isNotEmpty()) {
    
                    return $items;
                    
                }  else {
                    
                    throw new Exception('No item found in that category');

                }
                    
    
            }

            return Item::all();

        }
        
        catch (\Exception $e) {
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
            'category_id' => 'required'
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

    public function show(Item $item) {

        
        try {

            if ( $item ) { 

                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'price' => $item->price,
                    'description' => $item->description,
                    'category' => $item->category->name,
                ];

            } else {

                throw new Exception('item not found');

            }
            
        } catch (Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 404);
            
        }
        

    }
}
