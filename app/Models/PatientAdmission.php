<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="PatientAdmission",
 *     title="Patient Admission",
 *     description="Patient Admission model",
 *
 *     @OA\Property(property="id", type="integer", format="int64", example=1),
 *     @OA\Property(property="lastName", type="string", example="Smith"),
 *     @OA\Property(property="firstName", type="string", example="John"),
 *     @OA\Property(property="middleName", type="string", nullable=true, example="Robert"),
 *     @OA\Property(property="permanentAddress", type="string", example="123 Main St, Cityville"),
 *     @OA\Property(property="telephoneNumber", type="string", nullable=true, example="555-123-4567"),
 *     @OA\Property(property="sex", type="string", enum={"male", "female"}, example="male"),
 *     @OA\Property(property="civilStatus", type="string", enum={"single", "married", "widowed", "divorced"}, example="single"),
 *     @OA\Property(property="birthDate", type="string", format="date", example="1980-01-15"),
 *     @OA\Property(property="age", type="string", example="43"),
 *     @OA\Property(property="birthPlace", type="string", example="Springfield"),
 *     @OA\Property(property="nationality", type="string", example="American"),
 *     @OA\Property(property="religion", type="string", example="Christian"),
 *     @OA\Property(property="occupation", type="string", example="Engineer"),
 *     @OA\Property(property="employer", type="string", nullable=true, example="ABC Company"),
 *     @OA\Property(property="employerAddress", type="string", nullable=true, example="456 Business Ave"),
 *     @OA\Property(property="employerTelNo", type="string", nullable=true, example="555-987-6543"),
 *     @OA\Property(property="fatherName", type="string", nullable=true, example="Michael Smith"),
 *     @OA\Property(property="fatherAddress", type="string", nullable=true, example="789 Father St"),
 *     @OA\Property(property="fatherTelNo", type="string", nullable=true, example="555-222-3333"),
 *     @OA\Property(property="motherName", type="string", nullable=true, example="Susan Smith"),
 *     @OA\Property(property="motherAddress", type="string", nullable=true, example="789 Mother St"),
 *     @OA\Property(property="motherTelNo", type="string", nullable=true, example="555-444-5555"),
 *     @OA\Property(property="admissionDate", type="string", format="date", example="2025-04-10"),
 *     @OA\Property(property="admissionTime", type="string", example="14:30"),
 *     @OA\Property(property="dischargeDate", type="string", format="date", nullable=true, example="2025-04-13"),
 *     @OA\Property(property="dischargeTime", type="string", nullable=true, example="10:00"),
 *     @OA\Property(property="totalDays", type="string", nullable=true, example="3"),
 *     @OA\Property(property="attendingPhysician", type="string", example="Dr. Johnson"),
 *     @OA\Property(property="admissionType", type="string", enum={"new", "old", "former"}, example="new"),
 *     @OA\Property(property="referredBy", type="string", nullable=true, example="Dr. Williams"),
 *     @OA\Property(property="socialServiceClass", type="string", example="A"),
 *     @OA\Property(property="hospitalizationPlan", type="string", nullable=true, example="Corporate Healthcare"),
 *     @OA\Property(property="healthInsurance", type="string", nullable=true, example="Blue Shield"),
 *     @OA\Property(property="medicareType", type="string", enum={"gsis-member", "gsis-dependent", "sss-member", "sss-dependent", "owwa", "non-medicare", "indigent"}, nullable=true, example="sss-member"),
 *     @OA\Property(property="allergies", type="string", nullable=true, example="Penicillin, Peanuts"),
 *     @OA\Property(property="admissionDiagnosis", type="string", example="Acute appendicitis"),
 *     @OA\Property(property="principalDiagnosis", type="string", example="Appendicitis with peritonitis"),
 *     @OA\Property(property="otherDiagnosis", type="string", nullable=true, example="Mild dehydration"),
 *     @OA\Property(property="principalProcedure", type="string", nullable=true, example="Laparoscopic appendectomy"),
 *     @OA\Property(property="otherProcedures", type="string", nullable=true, example="IV fluid therapy"),
 *     @OA\Property(property="accidentDetails", type="string", nullable=true, example="N/A"),
 *     @OA\Property(property="placeOfOccurrence", type="string", nullable=true, example="N/A"),
 *     @OA\Property(property="disposition", type="string", enum={"discharged", "transferred", "dama", "absconded", "recovered", "improved", "unimproved", "died"}, example="improved"),
 *     @OA\Property(property="autopsyStatus", type="string", enum={"48-hours", "more-than-48", "autopsy", "no-autopsy"}, example="no-autopsy"),
 *     @OA\Property(property="created_at", type="string", format="date-time", nullable=true),
 *     @OA\Property(property="updated_at", type="string", format="date-time", nullable=true)
 * )
 */
class PatientAdmission extends Model
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

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function fullName()
    {
        return $this->firstName.' '.$this->middleName.' '.$this->lastName;
    }
}
