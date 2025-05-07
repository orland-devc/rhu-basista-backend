<?php

// app/Repositories/AppointmentRepository.php

namespace App\Repositories;

use App\Models\Appointment;

class AppointmentRepository
{
    public function getAll()
    {
        return Appointment::with('patient')->latest()->get();
    }

    public function getById($id)
    {
        return Appointment::with('patient')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Appointment::create($data);
    }

    public function update($id, array $data)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($data);

        return $appointment;
    }

    public function delete($id)
    {
        return Appointment::destroy($id);
    }

    public function getUpcoming()
    {
        return Appointment::where('scheduled_at', '>', now())->get();
    }

    public function getByPatientId($patientId)
    {
        return Appointment::where('patient_id', $patientId)->get();
    }
}
