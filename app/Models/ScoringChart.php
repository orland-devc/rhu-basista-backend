<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="ScoringChart",
 *     type="object",
 *     required={
 *         "patient_admission_id", "dateScored", "heartRate", "respiratory", "muscleTone", "reflexes", "color",
 *         "heartRate5", "respiratory5", "muscleTone5", "reflexes5", "color5",
 *         "heartRate10", "respiratory10", "muscleTone10", "reflexes10", "color10",
 *         "otherHeartRate", "otherRespiratory", "otherMuscleTone", "otherReflexes", "otherColor"
 *     },
 *
 *     @OA\Property(property="patient_admission_id", type="integer"),
 *     @OA\Property(property="dateScored", type="string", format="date"),
 *     @OA\Property(property="heartRate", type="integer"),
 *     @OA\Property(property="respiratory", type="integer"),
 *     @OA\Property(property="muscleTone", type="integer"),
 *     @OA\Property(property="reflexes", type="integer"),
 *     @OA\Property(property="color", type="integer"),

 *     @OA\Property(property="heartRate5", type="integer"),
 *     @OA\Property(property="respiratory5", type="integer"),
 *     @OA\Property(property="muscleTone5", type="integer"),
 *     @OA\Property(property="reflexes5", type="integer"),
 *     @OA\Property(property="color5", type="integer"),

 *     @OA\Property(property="heartRate10", type="integer"),
 *     @OA\Property(property="respiratory10", type="integer"),
 *     @OA\Property(property="muscleTone10", type="integer"),
 *     @OA\Property(property="reflexes10", type="integer"),
 *     @OA\Property(property="color10", type="integer"),

 *     @OA\Property(property="otherHeartRate", type="integer"),
 *     @OA\Property(property="otherRespiratory", type="integer"),
 *     @OA\Property(property="otherMuscleTone", type="integer"),
 *     @OA\Property(property="otherReflexes", type="integer"),
 *     @OA\Property(property="otherColor", type="integer")
 * )
 */
class ScoringChart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_admission_id',

        'dateScored',
        'heartRate',
        'respiratory',
        'muscleTone',
        'reflexes',
        'color',

        '5heartRate',
        '5respiratory',
        '5muscleTone',
        '5reflexes',
        '5color',

        '10heartRate',
        '10respiratory',
        '10muscleTone',
        '10reflexes',
        '10color',

        'otherHeartRate',
        'otherRespiratory',
        'otherMuscleTone',
        'otherReflexes',
        'otherColor',
    ];

    public function patientAdmission()
    {
        return $this->belongsTo(PatientAdmission::class);
    }
}
