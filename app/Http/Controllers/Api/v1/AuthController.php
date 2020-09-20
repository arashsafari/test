<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\v1\Address as AddressResource;
use App\Http\Resources\v1\User as UserResource;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create([
            'name'=> $request->name,
            'password'=> bcrypt($request->password),
            'email'=> $request->email,
        ]);
        $customer = Role::query()->where('name','customer')->first();
        if($customer != ''){
            $user->roles()->attach($customer->id);
        }
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['access_token' => $accessToken]);
    }

    public function address(Request $request)
    {
        $address = Address::create(array_merge($request->all(),['user_id' => auth('api')->user()->id]));
        return new AddressResource($address);
    }
    public function info()
    {
        $user = auth()->user();
        return new UserResource($user);
    }


}
