<?php

namespace App\Http\Controllers;

use App\Models\ActivityMutationServiceTol;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Exports\MutasiHarianExport;
use Maatwebsite\Excel\Facades\Excel;

class AktivitasHarianPetugasController extends Controller
{
    public function index(Request $request)
    {
        // Get current time
        $currentHour = now()->hour;
        $currentMinute = now()->minute;

        // Redirect to logout page if current time is between 6:43 to 6:45
        if ($currentHour == 6 && ($currentMinute >= 43 && $currentMinute <= 45)) {
            return redirect()->route('logout.index');
        }

        $tanggal_today = now()->toDateString();

        $ambulance = $request->session()->get('personil');
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $security = $request->session()->get('personilSecurity');
        $rescue = $request->session()->get('personilRescue');
        $senkom = $request->session()->get('personilSenkom');
        $derek = $request->session()->get('personilDerek');
        $tis = $request->session()->get('personilTis');

        // Find officer models
        $pa = Officer::find($ambulance);
        $p1 = Officer::find($personil1);
        $p2 = Officer::find($personil2);
        $ps = Officer::find($security);
        $pr = Officer::find($rescue);
        $psn = Officer::find($senkom);
        $ptis = Officer::find($tis);
        $pdk = Officer::find($derek);

        // Determine the time range based on current hour
        if ($currentHour >= 0 && $currentHour < 6) {
            $yesterdayTime = Carbon::yesterday()->setTime(22, 30);
            $todayStartTime = Carbon::today()->setTime(6, 45);
        } else {
            $yesterdayTime = Carbon::today()->setTime(22, 30);
            $todayStartTime = Carbon::tomorrow()->setTime(6, 45);
        }

        // Determine total activity count based on officer type
        if ($p1 != null && $p2 != null) {
            $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $personil1)
                ->where('personil2', $personil2)
                ->whereBetween('created_at', [$yesterdayTime, $todayStartTime])
                ->count();
        } elseif ($pa != null) {
            $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $ambulance)
                ->where('personil2', $ambulance)
                ->whereBetween('created_at', [$yesterdayTime, $todayStartTime])
                ->count();
        } elseif ($ps != null) {
            $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $security)
                ->where('personil2', $security)
                ->whereBetween('created_at', [$yesterdayTime, $todayStartTime])
                ->count();
        } elseif ($pr != null) {
            $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $rescue)
                ->where('personil2', $rescue)
                ->whereBetween('created_at', [$yesterdayTime, $todayStartTime])
                ->count();
        } elseif ($psn != null && $ptis != null) {
            $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $senkom)
                ->where('personil2', $tis)
                ->whereBetween('created_at', [$yesterdayTime, $todayStartTime])
                ->count();
        } elseif ($pdk != null) {
            $total = ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id)
                ->where('personil1', $derek)
                ->where('personil2', $derek)
                ->whereBetween('created_at', [$yesterdayTime, $todayStartTime])
                ->count();
        }

        return view("pages.dashboard-lalin.ashiap")->with(compact('total', 'p1', 'p2', 'ps', 'pa', 'pr', 'pdk'));
    }

  
}
