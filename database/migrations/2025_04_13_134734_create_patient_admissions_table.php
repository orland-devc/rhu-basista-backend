<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_admissions', function (Blueprint $table) {
            $table->id();

            // Patient Information
            $table->string('type')->required();
            $table->string('medRecNo')->unique();
            $table->string('lastName');
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->text('permanentAddress');
            $table->string('telephoneNumber')->nullable();
            $table->enum('sex', ['male', 'female']);
            $table->enum('civilStatus', ['single', 'married', 'widowed', 'divorced']);
            $table->date('birthDate');
            $table->string('age');
            $table->string('birthPlace');
            $table->string('nationality');
            $table->string('religion');
            $table->string('occupation');

            // Employment Information
            $table->string('employer')->nullable();
            $table->string('employerAddress')->nullable();
            $table->string('employerTelNo')->nullable();

            // Parents Information
            $table->string('fatherName')->nullable();
            $table->string('fatherAddress')->nullable();
            $table->string('fatherTelNo')->nullable();
            $table->string('motherName')->nullable();
            $table->string('motherAddress')->nullable();
            $table->string('motherTelNo')->nullable();

            // Admission Details
            $table->date('admissionDate');
            $table->string('admissionTime');
            $table->date('dischargeDate')->nullable();
            $table->string('dischargeTime')->nullable();
            $table->string('totalDays')->nullable();
            $table->string('attendingPhysician');
            $table->enum('admissionType', ['new', 'old', 'former']);
            $table->string('referredBy')->nullable();

            // Insurance & Classification
            $table->string('socialServiceClass');
            $table->string('hospitalizationPlan')->nullable();
            $table->string('healthInsurance')->nullable();
            $table->enum('medicareType', [
                'gsis-member', 'gsis-dependent', 'sss-member', 'sss-dependent',
                'owwa', 'non-medicare', 'indigent',
            ])->nullable();
            $table->text('allergies')->nullable();

            // Diagnosis & Procedures
            $table->text('admissionDiagnosis');
            $table->text('principalDiagnosis');
            $table->text('otherDiagnosis')->nullable();
            $table->text('principalProcedures')->nullable();
            $table->text('otherProcedures')->nullable();
            $table->string('accidentDetails')->nullable();
            $table->string('placeOfOccurrence')->nullable();

            // Disposition
            $table->enum('disposition', [
                'discharged', 'transferred', 'dama', 'absconded',
                'recovered', 'improved', 'unimproved', 'died',
            ]);
            $table->enum('autopsyStatus', [
                '48-hours', 'more-than-48', 'autopsy', 'no-autopsy',
            ]);

            $table->boolean('softDelete')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_admissions');
    }
}
