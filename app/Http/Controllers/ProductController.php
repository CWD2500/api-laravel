<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Valodator;
class ProductController extends Controller
{
    public function index()
    {
        $product =  Product::all();
        return responce()->json([
            'access'=> true,
            'message'=>'All  Message',
            'data'=>$product,
        ]);
    }

    //   create لا نتحتجاه لانو ماعن\نا  واجهة 



    public function store(Request $reques) 
    {
        $input =  $reques->all();
        $validtoer =  Valodator::make($input,
        [
            'name'=>'required',
            'details' =>'required',
        ]);

//   فشل 
        if ($validtoer->fails()) {
            return responce()->json([
                'fail'=> false,
                'message'=>'Sorry Not store',
                'error'=>$validtoer->errors()
            ]);
        }

        $product  =Product::create($input);

//   نجاح 
        return responce()->json([
            'access'=> true,
            'message'=>'Created SeccessFily',
            'product'=>$product,
        ]);
    }




    
    public function show($id) 
    {
        $product = Product::find($id);

//   فشل 
        if (is_null($product)) {
            return responce()->json([
                'fail'=> false,
                'message'=>'Sorry Not Found',
         
            ]);
        }

      
//   نجاح 
        return responce()->json([
            'access'=> true,
            'message'=>'Product fetched SeccessFily',
            'data'=>$product,
        ]);
    }




    
    public function update(Request $reques  , Product $product) 
    {
        $input =  $reques->all();
        $validtoer =  Valodator::make($input,
        [
            'name'=>'required',
            'details' =>'required',
        ]);

//   فشل 
        if ($validtoer->fails()) {
            return responce()->json([
                'fail'=> false,
                'message'=>'Sorry Not store',
                'error'=>$validtoer->errors()
            ]);
        }

        $product->name =$input['name'];
        $product->details =$input['details'];
        $product->save();

//   نجاح 
        return responce()->json([
            'access'=> true,
            'message'=>'Product Updated SeccessFily',
            'product'=>$product,
        ]);
    }



    

    
    public function delete( Product $product) 
    {
        $product->delete();

//   نجاح 
        return responce()->json([
            'access'=> true,
            'message'=>'has bin  Deleted',
            'product'=>$product,
        ]);
    }


}
