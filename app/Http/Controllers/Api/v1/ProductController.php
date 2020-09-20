<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductCollection;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\v1\Product as ProductResource;


class ProductController extends Controller
{
    public function index(){
        $this->authorize('products');
        $products = Product::query()->where('user_id',auth()->user()->id)->paginate(20);
        return new ProductCollection($products);
    }

    public function nearProduct(Request $request){
        if($request->lat != '' && $request->lng != '' && $request->area != ''){
            $address = Address::query()->where([
                    ['lat','<=',$request->lat + $request->area],
                    ['lat','>=',$request->lat - $request->area],
                    ['lng','<=',$request->lng + $request->area],
                    ['lng','>=',$request->lng - $request->area]
                ]
            )->latest()->pluck('id');
            $products = Product::query()->whereIn('address_id',$address)->paginate(20);

        }else{
            $products = Product::query()->paginate(20);
        }
        return new ProductCollection($products);
    }

    public function store(Request $request){
        $this->authorize('products');
        $product = Product::create(array_merge($request->all(),['user_id' => auth('api')->user()->id]));
        return new ProductResource($product);
    }

    public function update(Request $request,Product $product){
        $this->authorize('products');
        $product->update($request->all());
        return new ProductResource($product);
    }
}
