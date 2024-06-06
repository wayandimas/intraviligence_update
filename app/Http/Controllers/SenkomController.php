<?php

namespace App\Http\Controllers;

use App\Models\ActivityMutationServiceTol;
use App\Models\Officer;
use App\Models\Senkom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class SenkomController extends Controller
{
     public function index(Request $request){
        $id_senkom = 11;
        $id_tis = 14;
          $time = Carbon::now();
       
          $today = $time->toDateString();
          $yesterday = $time->subDay()->toDateString();
          $tomorrow = $time->addDay(2)->toDateString();
          $hour = $time->hour;
          $minute = $time->minute;
          $startTime = Carbon::parse('06:30:00')->format('H:i:s');
          $endTimeToday = Carbon::parse('23:59:59')->format('H:i:s');
          $endTimeTomorrow = Carbon::parse('06:30:00')->format('H:i:s');
          // dd($today,$yesterday,$tomorrow);
          
          if (($hour == 6 && $minute >= 46) || ($hour > 6 && $hour < 14) || ($hour == 14 && $minute <= 30)){
          $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama.'-%')
          ->where(function ($query) use ($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time) {
              $query->where(function ($q) use ($today, $startTime, $endTimeToday, $time) {
                  $q->whereDate('created_at', $today)
                    ->whereTime('created_at', '>=', $startTime)
                    ->whereTime('created_at', '<=', $time->format('H:i:s'));
              })
              ->orWhere(function ($q) use ($tomorrow, $endTimeTomorrow, $time) {
                  $q->whereDate('created_at', $tomorrow)
                    ->whereTime('created_at', '<=', $endTimeTomorrow)
                    ->whereTime('created_at', '<=', $time->format('H:i:s'));
              });
          })
          ->count();
              if ($jumlah_mutasi <16) {
                  $shift = 1;
              } elseif($jumlah_mutasi <32){
                  $shift = 2;
              } else{
                  $shift = 3;
              }
              
              
          }
          if (($hour == 14 && $minute >= 31) || ($hour > 14 && $hour < 22) || ($hour == 22 && $minute <= 30)){
              $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama.'-%')
          ->where(function ($query) use ($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time) {
              $query->where(function ($q) use ($today, $startTime, $endTimeToday, $time) {
                  $q->whereDate('created_at', $today)
                    ->whereTime('created_at', '>=', $startTime)
                    ->whereTime('created_at', '<=', $time->format('H:i:s'));
              })
              ->orWhere(function ($q) use ($tomorrow, $endTimeTomorrow, $time) {
                  $q->whereDate('created_at', $tomorrow)
                    ->whereTime('created_at', '<=', $endTimeTomorrow)
                    ->whereTime('created_at', '<=', $time->format('H:i:s'));
              });
          })
          ->count();
              if ($jumlah_mutasi <16) {
                  $shift = 1;
              } elseif($jumlah_mutasi <32){
                  $shift = 2;
              } else{
                  $shift = 3;
              }
   
          }
          if (($hour == 22 && $minute >= 31) || ($hour > 22 && $hour < 24) || ($hour < 6) || ($hour == 6 && $minute <= 45)) {
          // dd($hour);
          if($hour>=0&&$hour<6 || $hour ==6 && $minute<=45) {
              $endTimeYesterday = Carbon::parse('06:30:00')->format('H:i:s');
              $starttime3 = Carbon::parse('06:45:00')->format('H:i:s');
              $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama.'-%')
              ->where(function ($query) use ($today, $yesterday, $starttime3, $endTimeYesterday, $time) {
                  $query->where(function ($q) use ($yesterday, $endTimeYesterday, $time) {
                      $q->whereDate('created_at', $yesterday)
                        ->whereTime('created_at', '>=', $endTimeYesterday);
                  })
                  ->orWhere(function ($q) use ($today, $starttime3, $time) {
                      $q->whereDate('created_at', $today)
                        ->whereTime('created_at', '<=', $starttime3);
                  });
              })
              ->count();
              //   dd($jumlah_mutasi);
                  if ($jumlah_mutasi <16) {
                      $shift = 1;
                  } elseif($jumlah_mutasi <32){
                      $shift = 2;
                  } else{
                      $shift = 3;
                  }
          }   else{
              $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama.'-%')
              ->where(function ($query) use ($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time) {
                  $query->where(function ($q) use ($today, $startTime, $endTimeToday, $time) {
                      $q->whereDate('created_at', $today)
                        ->whereTime('created_at', '>=', $startTime)
                        ->whereTime('created_at', '<=', $time->format('H:i:s'));
                  })
                  ->orWhere(function ($q) use ($tomorrow, $endTimeTomorrow, $time) {
                      $q->whereDate('created_at', $tomorrow)
                        ->whereTime('created_at', '<=', $endTimeTomorrow)
                        ->whereTime('created_at', '<=', $time->format('H:i:s'));
                  });
              })
              ->count();
                  if ($jumlah_mutasi <16) {
                      $shift = 1;
                  } elseif($jumlah_mutasi <32){
                      $shift = 2;
                  } else{
                      $shift = 3;
                  }
          }
          
          }
   
        
        $p1 = Officer::where('operasional_id', $id_senkom)->get();
        $p2 = Officer::where('operasional_id', $id_tis)->get();
        return view("pages.senkom.index")->with(compact( 'p1', 'shift','p2'));
    }
    public function store(Request $request){
        $data = new Senkom;
        $data->personil1 = $request->personil1;
        $data->personil2 = $request->personil2;
        $request->session()->put('personilSenkom',$request->personil1);
        $request->session()->put('personilTis',$request->personil2);
        $data->shift = $request->shift;
        $data->save();


        return redirect()->route('dashboard-lalin.index');
    }
}
