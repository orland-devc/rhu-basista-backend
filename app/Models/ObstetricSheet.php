<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *   schema="ObstetricSheet",
 *   required={"patient_admission_id"},
 *
 *   @OA\Property(property="id", type="integer", format="int64", description="Obstetric sheet ID"),
 *   @OA\Property(property="patient_admission_id", type="integer", format="int64", description="Associated patient admission ID"),
 *   @OA\Property(property="reason_for_admission", type="string", description="Reason for admission"),
 *   @OA\Property(property="admitting_impression", type="string", description="Admitting impression"),
 *   @OA\Property(property="final_diagnosis", type="string", description="Final diagnosis"),
 *   @OA\Property(property="pertinent_medical_history", type="string", description="Pertinent medical history"),
 *   @OA\Property(property="educational_attainment", type="string", description="Educational attainment of the patient"),
 *   @OA\Property(property="lmp", type="string", format="date", description="Last menstrual period date"),
 *   @OA\Property(property="edc", type="string", format="date", description="Estimated date of confinement"),
 *   @OA\Property(property="aog", type="integer", description="Age of gestation in weeks"),
 *   @OA\Property(property="weeks_pmp", type="integer", description="Weeks post menstrual period"),
 *   @OA\Property(property="morning_sickness", type="boolean", description="Presence of morning sickness"),
 *   @OA\Property(property="quickening", type="string", description="Quickening observations"),
 *   @OA\Property(property="abnormal_signs", type="string", description="Abnormal signs noted"),
 *   @OA\Property(property="primary_antenatal_condition", type="string", description="Primary antenatal condition"),
 *   @OA\Property(property="antenatal_visits_first", type="string", format="date", description="Date of first antenatal visit"),
 *   @OA\Property(property="antenatal_visits_last", type="string", format="date", description="Date of last antenatal visit"),
 *   @OA\Property(property="contraceptive_methods", type="string", description="Contraceptive methods used"),
 *   @OA\Property(property="additional_children_wanted", type="string", description="Additional children wanted by the patient"),
 *   @OA\Property(property="history_of_present_illness", type="string", description="History of present illness"),
 *   @OA\Property(property="general_condition", type="string", description="General condition of the patient"),
 *   @OA\Property(property="bp", type="string", description="Blood pressure"),
 *   @OA\Property(property="hr", type="integer", description="Heart rate"),
 *   @OA\Property(property="rr", type="integer", description="Respiratory rate"),
 *   @OA\Property(property="temp", type="number", format="float", description="Body temperature"),
 *   @OA\Property(property="weight", type="number", format="float", description="Patient's weight"),
 *   @OA\Property(property="height", type="number", format="float", description="Patient's height"),
 *   @OA\Property(property="fundic_height", type="string", description="Fundic height measurement"),
 *   @OA\Property(property="presentation", type="string", description="Fetal presentation"),
 *   @OA\Property(property="engaged", type="boolean", description="Whether the fetal head is engaged"),
 *   @OA\Property(property="floating", type="boolean", description="Whether the fetal head is floating"),
 *   @OA\Property(property="efw", type="number", format="float", description="Estimated fetal weight"),
 *   @OA\Property(property="fht", type="integer", description="Fetal heart tone/rate"),
 *   @OA\Property(property="extremities", type="string", description="Condition of extremities"),
 *   @OA\Property(property="edema", type="string", description="Presence and degree of edema"),
 *   @OA\Property(property="albuminuria", type="boolean", description="Presence of albumin in urine"),
 *   @OA\Property(property="glucosuria", type="boolean", description="Presence of glucose in urine"),
 *   @OA\Property(property="hemoglobin", type="number", format="float", description="Hemoglobin level"),
 *   @OA\Property(property="created_at", type="string", format="date-time", description="Creation timestamp"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp")
 * )
 */
class ObstetricSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_admission_id',
        'reason_for_admission',
        'admitting_impression',
        'final_diagnosis',
        'pertinent_medical_history',

        'educational_attainment',
        'lmp',
        'edc',
        'aog',

        'weeks_pmp',
        'morning_sickness',
        'quickening',
        'abnormal_signs',

        'primary_antenatal_condition',
        'antenatal_visits_first',
        'antenatal_visits_last',

        'contraceptive_methods',
        'additional_children_wanted',
        'history_of_present_illness',

        'general_condition',
        'bp',
        'hr',
        'rr',
        'temp',
        'weight',
        'height',

        'fundic_height',
        'presentation',
        'engaged',
        'floating',
        'efw',
        'fht',

        'extremities',
        'edema',
        'albuminuria',
        'glucosuria',
        'hemoglobin',
    ];

    protected $casts = [
        'previous_pregnancies' => 'array',
        'lmp' => 'date',
        'edc' => 'date',
        'morning_sickness' => 'boolean',
        'engaged' => 'boolean',
        'floating' => 'boolean',
        'albuminuria' => 'boolean',
        'glucosuria' => 'boolean',
    ];

    public function patientAdmission()
    {
        return $this->belongsTo(PatientAdmission::class);
    }

    public function pregnancyRecords()
    {
        return $this->hasMany(PregnancyRecord::class);
    }
}
