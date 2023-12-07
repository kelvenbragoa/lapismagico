<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\City;
use App\Models\Country;
use App\Models\DegreeOfKinship;
use App\Models\Document;
use App\Models\Gender;
use App\Models\PaymentFrequency;
use App\Models\Province;
use App\Models\Registration;
use App\Models\SchoolYear;
use App\Models\Taxes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $searchQuery = request('query');

            $registrations = Registration::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('child_full_name','like',"%{$searchQuery}%");
            })
            ->with('schoolyear')
            ->orderBy('child_full_name','asc')
            ->paginate();

            return $registrations;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $schoolyear = SchoolYear::find($data['school_year_id']);

        $limitdate1 = mktime(0,0,0,1,30,$schoolyear->year);
        $limitdate = date('Y-m-d',$limitdate1);

       
       
        $registration = Registration::create($data);
        $tax1 = Taxes::find(1);
        $tax2 = Taxes::find(2);
        $tax3 = Taxes::find(3);
        $tax4 = Taxes::find(4);
        $tax5 = Taxes::find(5);
        $tax6 = Taxes::find(6);
        $tax7 = Taxes::find(7);


        Account::create([
            'registration_id'=>$registration->id,
            'entinty'=>'0000',
            'reference'=>'0000',
            'tax_id'=>1,
            'amount_to_pay'=> $tax1->amount,
            'expire_at'=> $limitdate,
            'status'=>0
        ]);

        Account::create([
            'registration_id'=>$registration->id,
            'entinty'=>'0000',
            'reference'=>'0000',
            'tax_id'=>2,
            'amount_to_pay'=> $tax2->amount,
            'expire_at'=> $limitdate,
            'status'=>0
        ]);

        Account::create([
            'registration_id'=>$registration->id,
            'entinty'=>'0000',
            'reference'=>'0000',
            'tax_id'=>3,
            'amount_to_pay'=> $tax3->amount,
            'expire_at'=> $limitdate,
            'status'=>0
        ]);

        if($data['payment_frequency_id']==1){
            for ($i=1; $i <=12 ; $i++) { 
                $limitdatetax1 = mktime(0,0,0,$i,10,$schoolyear->year);
                $limitdatetax = date('Y-m-d',$limitdatetax1);
                Account::create([
                    'registration_id'=>$registration->id,
                    'entinty'=>'0000',
                    'reference'=>'0000',
                    'tax_id'=>4,
                    'amount_to_pay'=> $tax4->amount,
                    'expire_at'=> $limitdatetax,
                    'status'=>0
                ]);
            }
        }elseif($data['school_year_id']==2){

            for ($i=3; $i <=12 ; $i*3) { 
                $limitdatetax1 = mktime(0,0,0,$i,10,$schoolyear->year);
                $limitdatetax = date('Y-m-d',$limitdatetax1);
                Account::create([
                    'registration_id'=>$registration->id,
                    'entinty'=>'0000',
                    'reference'=>'0000',
                    'tax_id'=>5,
                    'amount_to_pay'=> $tax5->amount,
                    'expire_at'=> $limitdatetax,
                    'status'=>0
                ]);
            }

        }elseif($data['school_year_id']==3){

            for ($i=6; $i <=12 ; $i*6) { 
                $limitdatetax1 = mktime(0,0,0,$i,10,$schoolyear->year);
                $limitdatetax = date('Y-m-d',$limitdatetax1);
                Account::create([
                    'registration_id'=>$registration->id,
                    'entinty'=>'0000',
                    'reference'=>'0000',
                    'tax_id'=>6,
                    'amount_to_pay'=> $tax6->amount,
                    'expire_at'=> $limitdatetax,
                    'status'=>0
                ]);
            }

        }elseif($data['school_year_id']==4){
            $limitdatetax1 = mktime(0,0,0,1,10,$schoolyear->year);
            $limitdatetax = date('Y-m-d',$limitdatetax1);
            Account::create([
                'registration_id'=>$registration->id,
                'entinty'=>'0000',
                'reference'=>'0000',
                'tax_id'=>6,
                'amount_to_pay'=> $tax7->amount,
                'expire_at'=> $limitdatetax,
                'status'=>0
            ]);
        }

        
        return [
            'message'=>'success'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $registration = Registration::
        with('schoolyear')
        ->with('childgender')
        ->with('childprovince')
        ->with('childcity')
        ->with('childdocument')
        ->with('childcountry')
        ->with('sponsorgender')
        ->with('sponsorprovince')
        ->with('sponsorcity')
        ->with('sponsordocument')
        ->with('sponsorcountry')
        ->with('sponsordegree')
        ->with('fathergender')
        ->with('fatherprovince')
        ->with('fathercity')
        // ->with('fatherdocument')
        ->with('fathercountry')
        ->with('mothergender')
        ->with('motherprovince')
        ->with('mothercity')
        // ->with('motherdocument')
        ->with('mothercountry')
        ->with('paymentfrequency')
        
        ->find($id);

        $account = Account::where('registration_id',$id)->with('tax')->get();


        return [
            'registration'=>$registration,
            'account'=>$account
        ];
        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $registration = Registration::find($id);
        $genders = Gender::all();
        $provinces = Province::all();
        $cities = City::all();
        $countries = Country::all();
        $degreekinships = DegreeOfKinship::all();
        $documents = Document::all();
        $schoolyears = SchoolYear::all();
        $frequencies = PaymentFrequency::all();

        return [
            'registration'=>$registration,
            'genders'=> $genders,
            'provinces'=> $provinces,
            'countries'=> $countries,
            'degreekinships'=> $degreekinships,
            'documents'=> $documents,
            'schoolyears'=> $schoolyears,
            'cities'=>$cities,
            'paymentfrequencies'=>$frequencies
        ];
        


        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();



        $registration = Registration::find($id);

        // if(request('image')){
            
        //     $imagePath = request('image')->store('registration','public');
        //     $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
        //     $image->save();
        //     $imageArray = ['child_image'=> $imagePath ];
            
        //     if($registration->child_image!=null){
        //         unlink("storage/".$registration->child_image);
        //     }
        // }

        // $registration->update($data);

        $registration->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return $registration;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $registration = Registration::find($id);

        // $registration->delete();
        $registration->update([
            'is_deleted'=>1
        ]);

        return true;
    }


    public function uploadimage(Request $request){

        $data = $request->all();

        if($request->hasFile('profile_picture')){

            
            $link = Storage::put('/photos',$request->file('profile_picture'));

            $registration = Registration::find($data['registration_id']);

            $registration->update([
                'child_image'=>$link
            ]);

            return [
                'registration'=>$registration
            ];
        }
        
    }
}
