<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Models\CheckIn;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use App\Http\Controllers\ApiController;
use Validator;


class AuthController extends ApiController
{
//    public function register(Request $request)
//    {
//
//        $validatedData = Validator::make(
//            $request->all(),
//            array(
//                'name' => 'required|max:55',
//                'username' => 'required|min:4',
//                'address' => 'required',
//                'cost_per_hour' => 'required',
//                'gender' => 'required',
//                'phone' => 'required',
//                'dob' => 'required',
//            ));
//        if ($validatedData->fails())
//        {
//            $error = $validatedData->errors()->first();
//            return $this->errorResponse($error, 200);
//        }
//
//        $validatedData = $request->all();
//
//        if ($request->hasFile('image')) {
//            if ($request->file('image')->isValid()) {
//                $this->validate($request, [
//                    'profile_pic' => 'image|mimes:jpeg,png,jpg'
//                ]);
//                $file = $request->file('image');
//                $destinationPath = public_path('/uploads/profile_images');
//                $image = $file->getClientOriginalName('image');
//                $image = rand().$image;
//
//
//                $request->file('image')->move($destinationPath, $image);
//                $validatedData['image'] = $image;
//
//            }
//        }else{
//            $validatedData['image'] = 'noimage.jpg';
//        }
//
//        //$user = User::create($validatedData);
//
//        $user = new User();
//        $user['name'] = $validatedData['name'];
//        $user['username'] = $validatedData['username'];
//        $user['gender'] = $validatedData['gender'];
//        $user['password'] = bcrypt($validatedData['password']);;
//        $user['image'] = $validatedData['image'];
//        $user['address'] = $validatedData['address'];
//        $user['cost_per_hour'] = $validatedData['cost_per_hour'];
//        $user['phone'] = $validatedData['phone'];
//        $user['dob'] = $validatedData['dob'];
//
//
//        $user->save();
//
//        $user->access_token = $user->createToken('authToken')->accessToken;
//
//        return $this->showOne($user, 200,'Register successful!');
//
//    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $not_active = User::where('name',$request->name)->where('active',0)->first();
        if($not_active){
            return $this->errorResponse('You account is not active', 200);
        }else{

            if(!auth()->attempt($loginData)) {
                return $this->errorResponse('Invalid Credentials',200);
            }
            $user = auth()->user();
            $user->access_token = auth()->user()->createToken('authToken')->accessToken;
            return $this->showOne($user, 200,'Login successful');
        }

        //return $loginData;

    }

//    public function update_profile(Request $request){
//
//        $validatedData = Validator::make(
//            $request->all(),
//            array(
//                'name' => 'required|max:55',
//            ));
//        if ($validatedData->fails())
//        {
//            $error = $validatedData->errors()->first();
//            return $this->errorResponse($error, 200);
//        }
//
//
//
//        $user_id = auth()->user()->id;
//
//        $validatedData = $request->all();
//        $user = User::find($user_id);
//
//
//
//
//        $validatedData['is_admin'] = 0;
//
//        if ($request->hasFile('profile_pic')) {
//
//            if ($request->file('profile_pic')->isValid()) {
//
//                $this->validate($request, [
//                    'profile_pic' => 'required|image|mimes:jpeg,png,jpg'
//                ]);
//
//                $file = $request->file('profile_pic');
//                $destinationPath = public_path('/uploads/profile_images');
//                $image = $file->getClientOriginalName('profile_pic');
//                $image = rand().$image;
//
//                $request->file('profile_pic')->move($destinationPath, $image);
//                $validatedData['profile_pic'] = $image;
//
//
//            }
//        }else{
//            $validatedData['profile_pic'] = $user->profile_pic;
//        }
//
//        if($request->dob){
//            $validatedData['dob'] = $request->dob;
//        }else{
//            $validatedData['dob'] = $user->dob;
//        }
//
//        if($request->gender){
//            $validatedData['gender'] = $request->gender;
//        }else{
//            $validatedData['gender'] = $user->gender;
//        }
//
//        if($request->password){
//            $validatedData['password'] = bcrypt($request->password);
//        }else{
//            $validatedData['password'] = $user->password;
//        }
//
//
//
//
//        $user->name = $validatedData['name'];
//        $user->is_admin = $validatedData['is_admin'];
//        $user->profile_pic = $validatedData['profile_pic'];
//        $user->dob = $validatedData['dob'];
//        $user->gender = $validatedData['gender'];
//        $user->password = $validatedData['password'];
//
//        $user->save();
//        //$user->access_token = $user->createToken('authToken')->accessToken;
//        //$user = auth()->user();
//
//        return $this->showOne($user, 200,'User updated');
//
//    }
}
