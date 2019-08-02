<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Product;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = Product::all();

        return $this->sendResponse($products->toArray(), 'Products received successfully');
    }

    public function store(Request $request){
         $input = $request->all();

         $validator = Validator::make($input, [
             'name' => 'required',
             'detail' => 'required'
         ]);
        
         if($validator->fails()){
             return $this->sendError('Validation Error.',$validator->errors());
         }

         $newProduct = Product::create($input);
         return $this->sendResponse($newProduct, 'Product created successfully');
     }

     /**
      * @param \Illuminate\Http\Request $request
      * @param int $id
      *
      * @returns \Illuminate\Http\Response
      */ 
     public function update(Request $request, Product $product){
         $input = $request->all();

         $validator = Validator::make($input, [
             'name' => 'required',
             'detail' => 'required'
         ]);

         if($validator->fails()){
            return $this->sendError('Validation Error.',$validator->errors());
         }

         $product->name = $input['name'];
         $product->detail = $input['detail'];
         $product->save();

         return $this->sendResponse($updatedProduct->toArray(), 'Product updated successfully');
     }

    /**
     * @param \Illuminate\Http\Request $request
     * @returns \Illuminate\Http\Response
     */
     public function destroy(Request $request){
        $product->delete();

        return $this->sendResponse($product->toArray(), 'Product deleted successfully.');

     }
}
