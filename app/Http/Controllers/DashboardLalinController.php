<?php

namespace App\Http\Controllers;

use App\Models\ActivityMutationServiceTol;
use App\Models\Officer;
use Auth, DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;

use function PHPUnit\Framework\returnSelf;

class DashboardLalinController extends Controller
{
    public function index(Request $request)
    {    // Mendapatkan tanggal hari ini
        $currentHour = date('H');
        $currentMinute = date('i');

        if ($currentHour == 6 && ($currentMinute >= 43 && $currentMinute <= 45)) {
           return redirect()->route('logout.index');
        }
        $tanggal_today= Carbon::now()->toDateString();
        $ambulance = $request->session()->get('personil');
        $security = $request->session()->get('personilSecurity');
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $rescue= $request->session()->get('personilRescue');
        $senkom = $request->session()->get('personilSenkom');
        $tis = $request->session()->get('personilTis');
        $derek = $request->session()->get('personilDerek');
        // dd($senkom);
        $pa= Officer::where('id', $ambulance)->first();
        $p1= Officer::where('id', $personil1)->first();
        $p2= Officer::where('id', $personil2)->first();
        $ps= Officer::where('id', $security)->first();
        $pr= Officer::where('id', $rescue)->first();
        $psn= Officer::where('id', $senkom)->first();
        $ptis= Officer::where('id', $tis)->first();
        $pdk = Officer::where('id', $derek)->first();
         if (($currentHour>=0&&$currentHour<6) || ($currentHour ==6 && $currentMinute<=45)) {
            $yesterdayTime = Carbon::yesterday()->setTime(22, 30);
            $todayStartTime = Carbon::today()->setTime(6, 45);
              if($p1!=null && $p2!=null){
           $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $personil1)
                ->where('personil2', $personil2)
                ->whereBetween('created_at', [$yesterdayTime,  $todayStartTime ])
                ->count();
            }
            else if($pa!=null){
                  $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $ambulance)
                ->where('personil2', $ambulance)
                ->whereBetween('created_at', [$yesterdayTime,  $todayStartTime ])
                ->count();
            }
             else if($ps!=null){
                      $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $security)
                ->where('personil2', $security)
                ->whereBetween('created_at', [$yesterdayTime,  $todayStartTime ])
                ->count();
            }
            
           
             else if($pr!=null){
                        $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $rescue)
                ->where('personil2', $rescue)
                ->whereBetween('created_at', [$yesterdayTime,  $todayStartTime ])
                ->count();
            
            }
           
              else if($psn!=null && $ptis!=null){
                           $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $senkom)
                ->where('personil2', $senkom)
                ->whereBetween('created_at', [$yesterdayTime,  $todayStartTime ])
                ->count();
            }
           
             else if($pdk!=null){
                   $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $derek)
                ->where('personil2', $derek)
                ->whereBetween('created_at', [$yesterdayTime,  $todayStartTime ])
                ->count();
            }
             else{
                 if(Auth::user()->operasional_id==1){
                    return redirect()->route('patroli.index');
                }
                elseif(Auth::user()->operasional_id==2)
                { return redirect()->route('derek.index');
                }
                elseif(Auth::user()->operasional_id==3)
                { return redirect()->route('rescue.index');
                }
                elseif(Auth::user()->operasional_id==4)
                { return redirect()->route('ambulan.index');
                }
                else
                { return redirect()->route('security.index');
                }
             }
               
       
            
        }else{
            if($p1!=null && $p2!=null){
            $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                ->where('personil1', $personil1)
                ->where('personil2', $personil2)
                ->whereDate('created_at',$tanggal_today)->count();
        }
            else if($pa!=null){
                $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                    ->where('personil1', $ambulance)
                    ->where('personil2', $ambulance)
                    ->whereDate('created_at',$tanggal_today)->count();
            }
            else if($ps!=null){
                     $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                    ->where('personil1', $security)
                    ->where('personil2', $security)
                    ->whereDate('created_at',$tanggal_today)->count();
            }
            else if($pr!=null){
                     $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                    ->where('personil1', $rescue)
                    ->where('personil2', $rescue)
                    ->whereDate('created_at',$tanggal_today)->count();
            }
            else if($psn!=null && $ptis!=null){
                     $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                    ->where('personil1', $senkom)
                    ->where('personil2', $tis)
                    ->whereDate('created_at',$tanggal_today)->count();
            }
            else if($pdk!=null){
                     $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                    ->where('personil1', $derek)
                    ->where('personil2', $derek)
                    ->whereDate('created_at',$tanggal_today)->count();
                  
            }
            else{
                if(Auth::user()->operasional_id==1){
                    return redirect()->route('patroli.index');
                }
                elseif(Auth::user()->operasional_id==2)
                { return redirect()->route('derek.index');
                }
                elseif(Auth::user()->operasional_id==3)
                { return redirect()->route('rescue.index');
                }
                elseif(Auth::user()->operasional_id==4)
                { return redirect()->route('ambulan.index');
                }
                else
                { return redirect()->route('security.index');
                }
            }
                
        }
        
           
        // dd($total);
        return view("pages.dashboard-lalin.index")->with(compact('total','p1','p2','pa', 'ps', 'pr', 'psn', 'ptis', 'pdk'));
    }
}
