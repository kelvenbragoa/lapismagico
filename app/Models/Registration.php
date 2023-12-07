<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function schoolyear(){
        return $this->hasOne('App\Models\SchoolYear', 'id', 'school_year_id');
    }

    public function childgender(){
        return $this->hasOne('App\Models\Gender', 'id', 'child_gender_id');
    }

    public function childdocument(){
        return $this->hasOne('App\Models\Document', 'id', 'child_document_id');
    }

    public function childcountry(){
        return $this->hasOne('App\Models\Country', 'id', 'child_country_id');
    }

    public function childprovince(){
        return $this->hasOne('App\Models\Province', 'id', 'child_province_id');
    }

    public function childcity(){
        return $this->hasOne('App\Models\City', 'id', 'child_city_id');
    }

    public function sponsorgender(){
        return $this->hasOne('App\Models\Gender', 'id', 'sponsor_education_gender_id');
    }

    public function sponsordocument(){
        return $this->hasOne('App\Models\Document', 'id', 'sponsor_education_document_id');
    }

    public function sponsorcountry(){
        return $this->hasOne('App\Models\Country', 'id', 'sponsor_education_country_id');
    }

    public function sponsorprovince(){
        return $this->hasOne('App\Models\Province', 'id', 'sponsor_education_province_id');
    }

    public function sponsorcity(){
        return $this->hasOne('App\Models\City', 'id', 'sponsor_education_city_id');
    }

    public function sponsordegree(){
        return $this->hasOne('App\Models\DegreeOfKinship', 'id', 'sponsor_education_degree_of_kinship_id');
    }

    public function fathergender(){
        return $this->hasOne('App\Models\Gender', 'id', 'father_gender_id');
    }

    // public function fatherdocument(){
    //     return $this->hasOne('App\Models\Document', 'id', 'father_document_id');
    // }

    public function fathercountry(){
        return $this->hasOne('App\Models\Country', 'id', 'father_country_id');
    }

    public function fatherprovince(){
        return $this->hasOne('App\Models\Province', 'id', 'father_province_id');
    }

    public function fathercity(){
        return $this->hasOne('App\Models\City', 'id', 'father_city_id');
    }

    public function fatherdegree(){
        return $this->hasOne('App\Models\DegreeOfKinship', 'id', 'father_degree_of_kinship_id');
    }

    public function mothergender(){
        return $this->hasOne('App\Models\Gender', 'id', 'mother_gender_id');
    }

    // public function motherdocument(){
    //     return $this->hasOne('App\Models\Document', 'id', 'mother_document_id');
    // }

    public function mothercountry(){
        return $this->hasOne('App\Models\Country', 'id', 'mother_country_id');
    }

    public function motherprovince(){
        return $this->hasOne('App\Models\Province', 'id', 'mother_province_id');
    }

    public function mothercity(){
        return $this->hasOne('App\Models\City', 'id', 'mother_city_id');
    }

    public function motherdegree(){
        return $this->hasOne('App\Models\DegreeOfKinship', 'id', 'mother_degree_of_kinship_id');
    }

    public function paymentfrequency(){
        return $this->hasOne('App\Models\PaymentFrequency', 'id', 'payment_frequency_id');
    }

    
}
