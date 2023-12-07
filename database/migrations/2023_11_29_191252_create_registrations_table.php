<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('school_year_id')->nullable();
            $table->integer('child_gender_id')->nullable();
            $table->string('child_full_name')->nullable();
            $table->string('child_document_id')->nullable();
            $table->string('child_document_number')->nullable();
            $table->date('child_date_of_birth')->nullable();
            $table->integer('child_country_id')->nullable();
            $table->integer('child_province_id')->nullable();
            $table->integer('child_city_id')->nullable();
            $table->string('child_address')->nullable();
            $table->string('child_address_number')->nullable();
            $table->string('child_address_locality')->nullable();
            $table->string('child_address_postal_code')->nullable();
            $table->string('child_son_of_first')->nullable();
            $table->string('child_son_of_second')->nullable();
            $table->string('child_image')->nullable();

            $table->string('sponsor_education_full_name')->nullable();
            $table->integer('sponsor_education_gender_id')->nullable();
            $table->string('sponsor_education_document_id')->nullable();
            $table->string('sponsor_education_document_number')->nullable();
            $table->date('sponsor_education_date_of_birth')->nullable();
            $table->integer('sponsor_education_country_id')->nullable();
            $table->integer('sponsor_education_province_id')->nullable();
            $table->integer('sponsor_education_city_id')->nullable();
            $table->string('sponsor_education_address')->nullable();
            $table->string('sponsor_education_address_number')->nullable();
            $table->string('sponsor_education_address_locality')->nullable();
            $table->string('sponsor_education_address_postal_code')->nullable();
            $table->string('sponsor_education_mobile')->nullable();
            $table->string('sponsor_education_cellphone')->nullable();
            $table->string('sponsor_education_work_phone')->nullable();
            $table->string('sponsor_education_email')->nullable();
            $table->string('sponsor_education_profession')->nullable();
            $table->string('sponsor_education_work_place')->nullable();
            $table->integer('sponsor_education_work_place_arround')->nullable();
            $table->integer('sponsor_education_degree_of_kinship_id')->nullable();

            $table->string('father_full_name')->nullable();
            $table->integer('father_gender_id')->nullable();
            $table->date('father_date_of_birth')->nullable();
            $table->integer('father_country_id')->nullable();
            $table->integer('father_province_id')->nullable();
            $table->integer('father_city_id')->nullable();
            $table->string('father_address')->nullable();
            $table->string('father_address_number')->nullable();
            $table->string('father_address_locality')->nullable();
            $table->string('father_address_postal_code')->nullable();
            $table->string('father_mobile')->nullable();
            $table->string('father_cellphone')->nullable();
            $table->string('father_work_phone')->nullable();
            $table->string('father_email')->nullable();
            $table->string('father_profession')->nullable();

            $table->string('mother_full_name')->nullable();
            $table->integer('mother_gender_id')->nullable();
            $table->date('mother_date_of_birth')->nullable();
            $table->integer('mother_country_id')->nullable();
            $table->integer('mother_province_id')->nullable();
            $table->integer('mother_city_id')->nullable();
            $table->string('mother_address')->nullable();
            $table->string('mother_address_number')->nullable();
            $table->string('mother_address_locality')->nullable();
            $table->string('mother_address_postal_code')->nullable();
            $table->string('mother_mobile')->nullable();
            $table->string('mother_cellphone')->nullable();
            $table->string('mother_work_phone')->nullable();
            $table->string('mother_email')->nullable();
            $table->string('mother_profession')->nullable();

            $table->integer('attended_nanny')->nullable();
            $table->integer('attended_day_care')->nullable();
            $table->integer('attended_pre_school')->nullable();
            $table->string('institute_name')->nullable();

            $table->integer('special_needs')->nullable();
            $table->string('special_needs_info')->nullable();

            $table->integer('delivered_support_documents')->nullable();
            $table->string('delivered_support_documents_info')->nullable();

            $table->string('assistant_doctor_full_name')->nullable();
            $table->string('consultation_location')->nullable();
            $table->string('assistant_doctor_mobile')->nullable();
            $table->string('assistant_doctor_email')->nullable();

            $table->string('authorized_person_1')->nullable();
            $table->integer('authorized_person_1_degree_of_kinship_id')->nullable();

            $table->string('authorized_person_2')->nullable();
            $table->integer('authorized_person_2_degree_of_kinship_id')->nullable();

            $table->string('authorized_person_3')->nullable();
            $table->integer('authorized_person_3_degree_of_kinship_id')->nullable();

            $table->string('authorized_person_4')->nullable();
            $table->integer('authorized_person_4_degree_of_kinship_id')->nullable();

            $table->string('authorized_person_5')->nullable();
            $table->integer('authorized_person_5_degree_of_kinship_id')->nullable();

            $table->date('date_registration')->nullable();
            $table->date('date_forecast_admission')->nullable();
            $table->date('date_admission')->nullable();
            $table->date('date_give_up')->nullable();
            $table->string('give_up_reason')->nullable();

            $table->integer('created_by_user_id')->nullable();
            $table->integer('registration_status_id')->nullable();
            $table->integer('is_deleted')->nullable();
            $table->integer('payment_frequency_id')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
