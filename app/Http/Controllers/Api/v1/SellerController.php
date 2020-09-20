<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\SellerCollection;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\v1\Seller as SellerResource;

class SellerController extends Controller
{
    public function add(Request $request){
        $this->authorize('users');
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create([
            'name'=> $request->name,
            'password'=> bcrypt($request->password),
            'email'=> $request->email,
            'level'=> 'seller',
        ]);
        $customer = Role::query()->where('name','seller')->first();
        if($customer != ''){
            $user->roles()->attach($customer->id);
        }
        return response([ 'user' => $user]);
    }
    function sellers(){
        $sellers = User::query()->where('level','seller')->get();
        return New SellerCollection($sellers);
    }
    function seller($id){
        $seller = User::query()->whereId($id)->first();
        return New SellerResource($seller);
    }

}
