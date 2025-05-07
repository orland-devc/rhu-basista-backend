<?php

// app/Http/Controllers/Api/AppointmentController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Repositories\AppointmentRepository;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Appointments",
 *     description="API Endpoints for managing appointments"
 * )
 */
class AppointmentController extends Controller
{
    protected $appointments;

    public function __construct(AppointmentRepository $appointments)
    {
        $this->appointments = $appointments;
    }

    /**
     * @OA\Get(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Get all appointments",
     *     @OA\Response(
     *         response=200,
     *         description="List of appointments"
     *     )
     * )
     */
    public function index()
    {
        $appointments = Appointment::all();

        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Get a specific appointment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Appointment details"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Appointment not found"
     *     )
     * )
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $appointment
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Create a new appointment",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"patient_id", "appointment_type", "scheduled_at"},
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="patient_name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="johndoe@hello.com"),
     *             @OA\Property(property="phone", type="string", example="555-123-4567"),
     *             @OA\Property(property="address", type="string", example="123 Main St, Cityville"),
     *             @OA\Property(property="appointment_type", type="string", enum={"prenatal", "delivery", "postnatal"}, example="prenatal"),
     *             @OA\Property(property="scheduled_at", type="string", format="date-time", example="2025-05-15T10:00:00"),
     *             @OA\Property(property="status", type="string", enum={"pending", "confirmed", "cancelled", "completed"}, example="pending")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Appointment created successfully"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'nullable|exists:patient_admissions,id',
            'patient_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'appointment_type' => 'required|in:prenatal,delivery,postnatal',
            'scheduled_at' => 'required|date|after_or_equal:now',
            'status' => 'nullable|in:pending,confirmed,cancelled,completed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $appointment = Appointment::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment created successfully',
            'data' => $appointment
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Update an existing appointment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="patient_name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="johndoe@hello.com"),
     *             @OA\Property(property="phone", type="string", example="555-123-4567"),
     *             @OA\Property(property="address", type="string", example="123 Main St, Cityville"),
     *             @OA\Property(property="appointment_type", type="string", enum={"prenatal", "delivery", "postnatal"}),
     *             @OA\Property(property="scheduled_at", type="string", format="date-time"),
     *             @OA\Property(property="status", type="string", enum={"pending", "confirmed", "cancelled", "completed"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Appointment updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Appointment not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'patient_id' => 'nullable|exists:patient_admissions,id',
            'patient_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'appointment_type' => 'sometimes|in:prenatal,delivery,postnatal',
            'scheduled_at' => 'sometimes|date|after_or_equal:now',
            'status' => 'sometimes|in:pending,confirmed,cancelled,completed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }
        $appointment->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment updated successfully',
            'data' => $appointment
        ]);}

    /**
     * @OA\Delete(
     *     path="/api/appointments/{id}",
     *     tags={"Appointments"},
     *     summary="Delete an appointment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Appointment deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Appointment not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found'
            ], 404);
        }

        $appointment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment deleted successfully'
        ]);
    }
}
