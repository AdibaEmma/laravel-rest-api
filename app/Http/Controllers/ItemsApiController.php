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
}
