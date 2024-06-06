<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash, Str, Validator, Lang, Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    // public function getUser(Request $request)
    // {
        
    //     return view("layouts.index")->with('datas', $datas);

    // }
    public function gate()
    {
        $check = Auth::check();
        // dd(Auth::user()->operasional_id);
        if($check)
            if(Auth::user()->operasional_id ==10)
                return redirect()->route('admin.dashboard.index');
            elseif(Auth::user()->operasional_id==13)
                return redirect()->route('superadmin.dashboard.index');
            elseif(Auth::user()->operasional_id==11)
                 return redirect()->route('dashboard-lalin.index');
            elseif(Auth::user()->operasional_id==7 || Auth::user()->operasional_id==8 ||Auth::user()->operasional_id==9)
                return redirect()->route('koordinator.dashboard.index');
            else
                return redirect()->route('dashboard-lalin.index');


        else
            return redirect()->route('login');
    }
    public function index(Request $request)
    {

       $check = Auth::check();

        if($check)
            if(Auth::user()->operasional_id ==10)
                return redirect()->route('admin.dashboard.index');
            elseif(Auth::user()->operasional_id==13)
                return redirect()->route('superadmin.dashboard.index');
            elseif(Auth::user()->operasional_id==11)
                 return redirect()->route('dashboard-lalin.index');
            elseif(Auth::user()->operasional_id==7||Auth::user()->operasional_id==8||Auth::user()->operasional_id==9)
                return redirect()->route('koordinator.dashboard.index');
            else
                return redirect()->route('dashboard-lalin.index');
        else
            $datas = User::all();
            return view('layouts.index')->with('datas', $datas);

    }
     public function post(Request $request)
    {
        $messages = [
            // 'user.required' => Lang::get('web.login-user.required'),
            'password.required' => Lang::get('web.login-password.required'),
        ];
    
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'password' => 'required',
        ], $messages);
    
        if($validator->fails())
        {
            $validator->errors()->add('login', Lang::get('User ID Tidak Boleh Kosong'));
            return redirect()->back()->withInput()->withErrors($validator);
        }
        // $test = Auth::attempt(['nama' => $request->user, 'password' => $request->password]);
        // dd($test);
        if(Auth::attempt(['nama' => $request->user, 'password' => $request->password])){
            $login = User::where('nama', $request->user)->first();
            // dd($login);
            if($login->operasional_id==10){

            }
            else{
                 if($login->session_token==null){
                $login->update([
                    'session_token' => $request->session()->getId(),
                ]);
            }else{
                if ($login->session_token !== $request->session()->getId()) {
                    Auth::logout(); // Logout the user
                    return redirect()->route('login')
                        ->with('error', 'Anda TIdak Bisa Login, Karena Akun Ini Sedang Dipakai Pada Device Lain');
                }
            }
            }
           
            
           
            if($login->operasional_id ==10 ){
                $request->session()->put('admin',$login->operasional_id);
                return redirect()->route('admin.dashboard.index');
            }
            if($login->operasional_id ==7 || $login->operasional_id==8 || $login->operasional_id==9 ){
                 $request->session()->put('koordPelayananTol',$login->operasional_id);
                return redirect()->route('koordinator.dashboard.index');
            }

             else if($login->operasional_id ==1){
                return redirect()->route('patroli.index');}
                

            else if($login->operasional_id ==13){
                return redirect()->route('superadmin.dashboard.index');

            }
            else if($login->operasional_id ==4){
                return redirect()->route('ambulan.index');
            }
            else if($login->operasional_id ==5){
                return redirect()->route('security.index');
            }
            else if($login->operasional_id ==3){
                return redirect()->route('rescue.index');
            }
            else if($login->operasional_id ==2){
                return redirect()->route('derek.index');
            }
            else if($login->operasional_id ==11){
                return redirect()->route('senkom.index');
            }
            else{
               
                $request->session()->put('intravilligence',$login->operasional_id);
                return redirect()->route('dashboard-lalin.index');
                
            }
        }
            
        else
            return redirect()->back()->withInput()->withErrors(['login' => Lang::get('User id atau password yang Anda masukkan salah. Silahkan login kembali!')]);
    }
      public function logout()
    {
        Auth::user()->update([
            'session_token' => null, // Clear the session_token
        ]);
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
    
   
  }

