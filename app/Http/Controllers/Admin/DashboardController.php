<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboarddata(){

        $users=User::count();
        $schoolyears=SchoolYear::count();
        $registrations=Registration::count();
        $schoolyearsdata = SchoolYear::get();
       
        return [
            'users' => $users,
            'schoolyears' => $schoolyears,
            'totalRegistrations' => $registrations,
            'schoolyearsdata'=>$schoolyearsdata
        ];
    }


    public function getRegistrationCount(Request $request){
        $data = $request->all();
        if($data['year'] == 0){
            $totalRegistrations = Registration::count();
        }else{
            $totalRegistrations = Registration::where('school_year_id',$data['year'])->count();
        }
        
        return response()->json([
            'totalRegistrations'=>$totalRegistrations
        ]);
    }

    public function mcscrcount($id){

        $totalMcscrCount = Registration::query()
        ->when(request('date_range') === 'total',function($query){
            
        })
        ->when(request('date_range') === 'today',function($query){
            $query->whereBetween('created_at',[now()->today(),now()]);
        })
        ->when(request('date_range') === '30',function($query){
            $query->whereBetween('created_at',[now()->subDays(30),now()]);
        })
        ->when(request('date_range') === '60',function($query){
            $query->whereBetween('created_at',[now()->subDays(60),now()]);
        })
        ->when(request('date_range') === '360',function($query){
            $query->whereBetween('created_at',[now()->subDays(360),now()]);
        })
        ->when(request('date_range') === 'monthtodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfMonth(),now()]);
        })
        ->when(request('date_range') === 'yeartodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfYear(),now()]);
        })
        ->where('equipment_id',$id)
        ->count();


        return response()->json([
            'totalMcscrCount'=>$totalMcscrCount
        ]);
    }
}
