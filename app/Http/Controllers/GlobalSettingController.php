<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Spatie\Valuestore\Valuestore;

class GlobalSettingController extends Controller
{

     function __construct()
     {
          $this->middleware('permission:app-setting', ['only' => ['update']])->except('updateProfile');
     }

     public function update(Request $request){
          $settings = Valuestore::make(storage_path('app/settings.json'));
          $settings->put('app_name', $request->appName);

          if (request()->hasFile('applogo')) {
          $file = request()->file('applogo');
          $image = $file->hashName();
          $file->storeAs('settings','/'.$image,'');
          $settings->put('app_logo',$image);

          }
          return redirect()->back()->with(['success' => 'Settings updated']);
     }

     public function updateProfile(Request $request,$id){
          $request->validate([
               'name' => 'required',
               'email' => 'required|email|unique:users,email,'.$id,
               'password' => 'same:confirm-password',
           ]);
       
           $input = $request->all();
           if(!empty($input['password'])){ 
               $input['password'] = Hash::make($input['password']);
           }else{
               $input = Arr::except($input,array('password'));    
           }
       
           $user = User::find($id);
           $user->update($input);
        
       
           return redirect()->route('profile')
                           ->with('success','Your profile has been updated successfully');

     }
}
