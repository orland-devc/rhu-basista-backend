<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PatientAdmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *     title="Medical Admission API",
 *     version="1.0.0",
 *     description="API for managing medical patient admissions"
 * )
 */
class PatientAdmissionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/patient-admissions",
     *     summary="Get all patient admissions",
     *     tags={"Patient Admissions"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(ref="#/components/schemas/PatientAdmission")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $admissions = PatientAdmission::where('softDelete', 0)->get();

        return response()->json([
            'status' => 'success',
            'data' => $admissions,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/patient-admissions",
     *     summary="Create a new patient admission",
     *     tags={"Patient Admissions"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/PatientAdmission")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Patient admission created successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/PatientAdmission")
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'medRecNo' => 'nullable|string|unique:patient_admissions,medRecNo',
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'permanentAddress' => 'required|string',
            'telephoneNumber' => 'nullable|string|max:20',
            'sex' => 'required|in:male,female',
            'civilStatus' => 'required|in:single,married,widowed,divorced',
            'birthDate' => 'required|date',
            'age' => 'required|string',
            'birthPlace' => 'required|string',
            'nationality' => 'required|string',
            'religion' => 'required|string',
            'occupation' => 'required|string',
            'employer' => 'nullable|string',
            'employerAddress' => 'nullable|string',
            'employerTelNo' => 'nullable|string',
            'fatherName' => 'nullable|string',
            'fatherAddress' => 'nullable|string',
            'fatherTelNo' => 'nullable|string',
            'motherName' => 'nullable|string',
            'motherAddress' => 'nullable|string',
            'motherTelNo' => 'nullable|string',
            'admissionDate' => 'required|date',
            'admissionTime' => 'required|string',
            'dischargeDate' => 'nullable|date',
            'dischargeTime' => 'nullable|string',
            'totalDays' => 'nullable|string',
            'attendingPhysician' => 'required|string',
            'admissionType' => 'required|in:new,old,former',
            'referredBy' => 'nullable|string',
            'socialServiceClass' => 'required|string',
            'hospitalizationPlan' => 'nullable|string',
            'healthInsurance' => 'nullable|string',
            'medicareType' => 'nullable|in:gsis-member,gsis-dependent,sss-member,sss-dependent,owwa,non-medicare,indigent',
            'allergies' => 'nullable|string',
            'admissionDiagnosis' => 'required|string',
            'principalDiagnosis' => 'required|string',
            'otherDiagnosis' => 'nullable|string',
            'principalProcedures' => 'nullable|string',
            'otherProcedures' => 'nullable|string',
            'accidentDetails' => 'nullable|string',
            'placeOfOccurrence' => 'nullable|string',
            'disposition' => 'required|in:discharged,transferred,dama,absconded,recovered,improved,unimproved,died',
            'autopsyStatus' => 'required|in:48-hours,more-than-48,autopsy,no-autopsy',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admission = PatientAdmission::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Patient admission created successfully',
            'data' => $admission,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/patient-admissions/{id}",
     *     summary="Get patient admission by ID",
     *     tags={"Patient Admissions"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Patient admission ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/PatientAdmission")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Patient admission not found"
     *     )
     * )
     */
    public function show($id)
    {
        $admission = PatientAdmission::find($id);

        if (! $admission) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient admission not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $admission,
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/patient-admissions/{id}",
     *     summary="Update patient admission",
     *     tags={"Patient Admissions"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Patient admission ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/PatientAdmission")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Patient admission updated successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/PatientAdmission")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Patient admission not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $admission = PatientAdmission::find($id);

        if (! $admission) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient admission not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'sometimes|required|string',
            'medRecNo' => 'sometimes|required|string|unique:patient_admissions,medRecNo,',
            'lastName' => 'sometimes|required|string|max:255',
            'firstName' => 'sometimes|required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'permanentAddress' => 'sometimes|required|string',
            'telephoneNumber' => 'nullable|string|max:20',
            'sex' => 'sometimes|required|in:male,female',
            'civilStatus' => 'sometimes|required|in:single,married,widowed,divorced',
            'birthDate' => 'sometimes|required|date',
            'age' => 'sometimes|required|string',
            'birthPlace' => 'sometimes|required|string',
            'nationality' => 'sometimes|required|string',
            'religion' => 'sometimes|required|string',
            'occupation' => 'sometimes|required|string',
            'employer' => 'nullable|string',
            'employerAddress' => 'nullable|string',
            'employerTelNo' => 'nullable|string',
            'fatherName' => 'nullable|string',
            'fatherAddress' => 'nullable|string',
            'fatherTelNo' => 'nullable|string',
            'motherName' => 'nullable|string',
            'motherAddress' => 'nullable|string',
            'motherTelNo' => 'nullable|string',
            'admissionDate' => 'sometimes|required|date',
            'admissionTime' => 'sometimes|required|string',
            'dischargeDate' => 'nullable|date',
            'dischargeTime' => 'nullable|string',
            'totalDays' => 'nullable|string',
            'attendingPhysician' => 'sometimes|required|string',
            'admissionType' => 'sometimes|required|in:new,old,former',
            'referredBy' => 'nullable|string',
            'socialServiceClass' => 'sometimes|required|string',
            'hospitalizationPlan' => 'nullable|string',
            'healthInsurance' => 'nullable|string',
            'medicareType' => 'nullable|in:gsis-member,gsis-dependent,sss-member,sss-dependent,owwa,non-medicare,indigent',
            'allergies' => 'nullable|string',
            'admissionDiagnosis' => 'sometimes|required|string',
            'principalDiagnosis' => 'sometimes|required|string',
            'otherDiagnosis' => 'nullable|string',
            'principalProcedures' => 'nullable|string',
            'otherProcedures' => 'nullable|string',
            'accidentDetails' => 'nullable|string',
            'placeOfOccurrence' => 'nullable|string',
            'disposition' => 'sometimes|required|in:discharged,transferred,dama,absconded,recovered,improved,unimproved,died',
            'autopsyStatus' => 'sometimes|required|in:48-hours,more-than-48,autopsy,no-autopsy',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admission->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Patient admission updated successfully',
            'data' => $admission,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/patient-admissions/{id}",
     *     summary="Delete patient admission",
     *     tags={"Patient Admissions"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Patient admission ID",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Patient admission deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient admission not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $admission = PatientAdmission::find($id);

        if (! $admission) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient admission not found',
            ], 404);
        }

        // $admission->delete();
        $admission->softDelete = true;
        $admission->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Patient admission deleted successfully',
        ], 200);
    }
}
