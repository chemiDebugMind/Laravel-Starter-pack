<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Valuestore\Valuestore;

class GlobalSettingController extends Controller
{

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
}
