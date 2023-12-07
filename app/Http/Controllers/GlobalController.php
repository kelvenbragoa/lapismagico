<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\DegreeOfKinship;
use App\Models\Document;
use App\Models\Gender;
use App\Models\PaymentFrequency;
use App\Models\Province;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    //

    public function auxiliaregistration(){
    
        //
        $genders = Gender::all();
        $provinces = Province::all();
        $countries = Country::all();
        $degreekinships = DegreeOfKinship::all();
        $documents = Document::all();
        $schoolyears = SchoolYear::all();
        $frequencies = PaymentFrequency::all();

        return [
            'genders'=> $genders,
            'provinces'=> $provinces,
            'countries'=> $countries,
            'degreekinships'=> $degreekinships,
            'documents'=> $documents,
            'schoolyears'=> $schoolyears,
            'paymentfrequencies'=>$frequencies
        ];

    
    }

    public function auxiliaregistrationcity1($id){
        $cities1 = City::where('province_id',$id)->orderBy('name','asc')->get();
        return [
            'cities1'=>$cities1,
            ];
    }

    public function auxiliaregistrationcity2($id){
        $cities2 = City::where('province_id',$id)->orderBy('name','asc')->get();
        return [
            'cities2'=>$cities2,
            ];
    }

    public function auxiliaregistrationcity3($id){
        $cities3 = City::where('province_id',$id)->orderBy('name','asc')->get();
        return [
            'cities3'=>$cities3,
            ];
    }

    public function auxiliaregistrationcity4($id){
        $cities4 = City::where('province_id',$id)->orderBy('name','asc')->get();
        return [
            'cities4'=>$cities4,
            ];
    }
}
