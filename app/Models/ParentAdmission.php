<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentAdmission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastName',
        'firstName',
        'middleName',
        'permanentAddress',
        'telephoneNumber',
        'sex',
        'civilStatus',
        'birthDate',
        'age',
        'birthPlace',
        'nationality',
        'religion',
        'occupation',
        'employer',
        'employerAddress',
        'employerTelNo',
        'fatherName',
        'fatherAddress',
        'fatherTelNo',
        'motherName',
        'motherAddress',
        'motherTelNo',
        'admissionDate',
        'admissionTime',
        'dischargeDate',
        'dischargeTime',
        'totalDays',
        'attendingPhysician',
        'admissionType',
        'referredBy',
        'socialServiceClass',
        'hospitalizationPlan',
        'healthInsurance',
        'medicareType',
        'allergies',
        'admissionDiagnosis',
        'principalDiagnosis',
        'otherDiagnosis',
        'principalProcedure',
        'otherProcedures',
        'accidentDetails',
        'placeOfOccurrence',
        'disposition',
        'autopsyStatus',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthDate' => 'date',
        'admissionDate' => 'date',
        'dischargeDate' => 'date',
    ];
}
