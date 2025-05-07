<?php

// app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Apppointment",
 *     title="Appointment",
 *     description="Appointment model",
 *
 *    @OA\Property(property="id", type="integer", format="int64", example=1),
 *    @OA\Property(property="patient_id", type="integer", format="int64", example=1),
 *    @OA\Property(property="patient_name", type="string", example="John Doe"),
 *    @OA\Property(property="email", type="string", example="johndoe@hello.com"),
 *    @OA\Property(property="phone", type="string", example="555-123-4567"),
 *    @OA\Property(property="address", type="string", example="123 Main St, Cityville"),
 *    @OA\Property(property="appointment_type", type="string", enum={"prenatal", "delivery", "postnatal"}, example="prenatal"),
 *    @OA\Property(property="scheduled_at", type="string", format="date-time", example="2025-04-10T14:30:00Z"),
 *    @OA\Property(property="status", type="string", enum={"pending", "confirmed", "cancelled"}, example="pending"),
 *    @OA\Property(property="created_at", type="string", format="date-time", nullable=true),
 *    @OA\Property(property="updated_at", type="string", format="date-time", nullable=true)
 * )
 */
class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'patient_name',
        'email',
        'phone',
        'address',
        'appointment_type',
        'scheduled_at',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($appointment) {
            if ($appointment->patient_id && empty($appointment->patient_name)) {
                $patient = PatientAdmission::find($appointment->patient_id);
                if ($patient) {
                    $appointment->patient_name = $patient->fullName();
                    $appointment->phone = $patient->telephoneNumber;
                    $appointment->address = $patient->permanentAddress;
                }
            }
        });

        static::updating(function ($appointment) {
            if ($appointment->isDirty('patient_id')) {
                $patient = PatientAdmission::find($appointment->patient_id);
                if ($patient) {
                    $appointment->patient_name = $patient->fullName();
                    $appointment->phone = $patient->telephoneNumber;
                    $appointment->address = $patient->permanentAddress;
                }
            }
        });
    }

    public function patient()
    {
        return $this->belongsTo(PatientAdmission::class);
    }
}
