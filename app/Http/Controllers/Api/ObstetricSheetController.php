<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ObstetricSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ObstetricSheetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/obstetric-sheets",
     *     tags={"Obstetric Sheets"},
     *     summary="Get all obstetric sheets",
     *
     *     @OA\Response(response=200, description="Successful retrieval")
     * )
     */
    public function index()
    {
        $obstetricSheet = ObstetricSheet::all();

        return response()->json([
            'status' => 'success',
            'data' => $obstetricSheet,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/obstetric-sheets",
     *     tags={"Obstetric Sheets"},
     *     summary="Create a new obstetric sheet",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/ObstetricSheet")
     *     ),
     *
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=400, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_admission_id' => 'required|string',
            'reason_for_admission' => 'nullable|string',
            'admitting_impression' => 'nullable|string',
            'final_diagnosis' => 'nullable|string',
            'pertinent_medical_history' => 'nullable|string',
            'educational_attainment' => ['nullable', Rule::in(['Elementary', 'High School', 'College Graduate'])],
            'previous_pregnancies' => 'nullable|array|max:6',
            'previous_pregnancies.*.label' => 'required|string|in:G1,G2,G3,G4,G5,G6',
            'previous_pregnancies.*.year' => 'nullable|integer',
            'previous_pregnancies.*.aog' => 'nullable|string',
            'previous_pregnancies.*.manner' => 'nullable|string',
            'previous_pregnancies.*.place' => 'nullable|string',
            'previous_pregnancies.*.gender' => 'nullable|string',
            'previous_pregnancies.*.weight' => 'nullable|numeric',
            'previous_pregnancies.*.complications' => 'nullable|string',
            'previous_pregnancies.*.status' => 'nullable|string',

            'lmp' => 'nullable|date',
            'edc' => 'nullable|date',
            'aog' => 'nullable|integer',
            'weeks_pmp' => 'nullable|integer',
            'morning_sickness' => 'nullable|boolean',
            'quickening' => 'nullable|date',
            'abnormal_signs' => 'nullable|string',
            'primary_antenatal_condition' => 'nullable|string',
            'antenatal_visits_first' => 'nullable|integer',
            'antenatal_visits_last' => 'nullable|integer',
            'contraceptive_methods' => 'nullable|string',
            'additional_children_wanted' => 'nullable|integer',
            'history_of_present_illness' => 'nullable|string',

            'general_condition' => 'nullable|string',
            'bp' => 'nullable|string',
            'hr' => 'nullable|integer',
            'rr' => 'nullable|integer',
            'temp' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'fundic_height' => 'nullable|numeric',
            'presentation' => 'nullable|string',
            'engaged' => 'nullable|boolean',
            'floating' => 'nullable|boolean',
            'efw' => 'nullable|numeric',
            'fht' => 'nullable|string',
            'extremities' => 'nullable|string',
            'edema' => 'nullable|string',
            'albuminuria' => 'nullable|boolean',
            'glucosuria' => 'nullable|boolean',
            'hemoglobin' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $sheet = ObstetricSheet::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Obstetric sheet created successfully',
            'data' => $sheet,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/obstetric-sheets/{id}",
     *     tags={"Obstetric Sheets"},
     *     summary="Retrieve a single obstetric sheet",
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id)
    {
        $sheet = ObstetricSheet::find($id);

        if (! $sheet) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $sheet,
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/obstetric-sheets/{id}",
     *     tags={"Obstetric Sheets"},
     *     summary="Update a specific obstetric sheet",
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/ObstetricSheet")
     *     ),
     *
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=400, description="Validation error")
     * )
     */
    public function update(Request $request, $id)
    {
        $sheet = ObstetricSheet::find($id);

        if (! $sheet) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            // ... repeat rules as in store
            'patient_admission_id' => 'sometimes|string',
            'reason_for_admission' => 'nullable|string',
            'admitting_impression' => 'nullable|string',
            'final_diagnosis' => 'nullable|string',
            'pertinent_medical_history' => 'nullable|string',
            'educational_attainment' => ['nullable', Rule::in(['Elementary', 'High School', 'College Graduate'])],
            'previous_pregnancies' => 'nullable|array|max:6',
            'previous_pregnancies.*.label' => 'sometimes|string|in:G1,G2,G3,G4,G5,G6',
            'previous_pregnancies.*.year' => 'nullable|integer',
            'previous_pregnancies.*.aog' => 'nullable|string',
            'previous_pregnancies.*.manner' => 'nullable|string',
            'previous_pregnancies.*.place' => 'nullable|string',
            'previous_pregnancies.*.gender' => 'nullable|string',
            'previous_pregnancies.*.weight' => 'nullable|numeric',
            'previous_pregnancies.*.complications' => 'nullable|string',
            'previous_pregnancies.*.status' => 'nullable|string',

            'lmp' => 'nullable|date',
            'edc' => 'nullable|date',
            'aog' => 'nullable|integer',
            'weeks_pmp' => 'nullable|integer',
            'morning_sickness' => 'nullable|boolean',
            'quickening' => 'nullable|date',
            'abnormal_signs' => 'nullable|string',
            'primary_antenatal_condition' => 'nullable|string',
            'antenatal_visits_first' => 'nullable|integer',
            'antenatal_visits_last' => 'nullable|integer',
            'contraceptive_methods' => 'nullable|string',
            'additional_children_wanted' => 'nullable|integer',
            'history_of_present_illness' => 'nullable|string',

            'general_condition' => 'nullable|string',
            'bp' => 'nullable|string',
            'hr' => 'nullable|integer',
            'rr' => 'nullable|integer',
            'temp' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'fundic_height' => 'nullable|numeric',
            'presentation' => 'nullable|string',
            'engaged' => 'nullable|boolean',
            'floating' => 'nullable|boolean',
            'efw' => 'nullable|numeric',
            'fht' => 'nullable|string',
            'extremities' => 'nullable|string',
            'edema' => 'nullable|string',
            'albuminuria' => 'nullable|boolean',
            'glucosuria' => 'nullable|boolean',
            'hemoglobin' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $sheet->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Sheet updated successfully',
            'data' => $sheet,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/obstetric-sheets/{id}",
     *     tags={"Obstetric Sheets"},
     *     summary="Delete a specific obstetric sheet",
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($id)
    {
        $sheet = ObstetricSheet::find($id);

        if (! $sheet) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $sheet->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Sheet deleted successfully.',
        ], 204);
    }
}
