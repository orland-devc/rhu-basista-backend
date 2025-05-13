<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScoringChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ScoringChartController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/scoring-charts",
     *     summary="Get all scoring charts",
     *     tags={"ScoringChart"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(ref="#/components/schemas/ScoringChart")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $scoringCharts = ScoringChart::all();

        if ($scoringCharts->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No scoring charts found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $scoringCharts], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/scoring-charts",
     *     summary="Create a new scoring chart",
     *     tags={"ScoringChart"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/ScoringChart")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Scoring Chart created successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ScoringChart")
     *     ),
     *
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_admission_id' => [
                'required',
                Rule::exists('patient_admissions', 'id'),
            ],
            'dateScored' => 'nullable|date',
            'heartRate' => 'nullable|integer',
            'respiratory' => 'nullable|integer',
            'muscleTone' => 'nullable|integer',
            'reflexes' => 'nullable|integer',
            'color' => 'nullable|integer',

            'heartRate5' => 'nullable|integer',
            'respiratory5' => 'nullable|integer',
            'muscleTone5' => 'nullable|integer',
            'reflexes5' => 'nullable|integer',
            'color5' => 'nullable|integer',

            'heartRate10' => 'nullable|integer',
            'respiratory10' => 'nullable|integer',
            'muscleTone10' => 'nullable|integer',
            'reflexes10' => 'nullable|integer',
            'color10' => 'nullable|integer',

            'otherHeartRate' => 'nullable|integer',
            'otherRespiratory' => 'nullable|integer',
            'otherMuscleTone' => 'nullable|integer',
            'otherReflexes' => 'nullable|integer',
            'otherColor' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
        }

        $scoringChart = ScoringChart::create($request->all());

        return response()->json(['status' => 'success', 'data' => $scoringChart], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/scoring-charts/{id}",
     *     summary="Get scoring chart by ID",
     *     tags={"ScoringChart"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *         description="Scoring chart ID", @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(response=200, description="Success", @OA\JsonContent(ref="#/components/schemas/ScoringChart")),
     *     @OA\Response(response=404, description="Chart not found")
     * )
     */
    public function show($id)
    {
        $scoringChart = ScoringChart::find($id);

        if (! $scoringChart) {
            return response()->json(['status' => 'error', 'message' => 'Scoring chart not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $scoringChart], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/scoring-charts/{id}",
     *     summary="Update APGAR scoring chart",
     *     tags={"ScoringChart"},
     *
     *     @OA\Parameter(
     *         name="id", in="path", required=true,
     *         description="Scoring chart ID", @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/ScoringChart")
     *     ),
     *
     *     @OA\Response(response=200, description="Updated successfully", @OA\JsonContent(ref="#/components/schemas/ScoringChart")),
     *     @OA\Response(response=404, description="Not found"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function update(Request $request, $id)
    {
        $scoringChart = ScoringChart::find($id);

        if (! $scoringChart) {
            return response()->json(['status' => 'error', 'message' => 'Scoring chart not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'patient_admission_id' => [
                'required',
                Rule::exists('patient_admissions', 'id')->whereNull('deleted_at'),
            ],
            'dateScored' => 'nullable|date',
            'heartRate' => 'nullable|integer',
            'respiratory' => 'nullable|integer',
            'muscleTone' => 'nullable|integer',
            'reflexes' => 'nullable|integer',
            'color' => 'nullable|integer',

            'heartRate5' => 'nullable|integer',
            'respiratory5' => 'nullable|integer',
            'muscleTone5' => 'nullable|integer',
            'reflexes5' => 'nullable|integer',
            'color5' => 'nullable|integer',

            'heartRate10' => 'nullable|integer',
            'respiratory10' => 'nullable|integer',
            'muscleTone10' => 'nullable|integer',
            'reflexes10' => 'nullable|integer',
            'color10' => 'nullable|integer',

            'otherHeartRate' => 'nullable|integer',
            'otherRespiratory' => 'nullable|integer',
            'otherMuscleTone' => 'nullable|integer',
            'otherReflexes' => 'nullable|integer',
            'otherColor' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
        }

        $scoringChart->update($request->all());

        return response()->json(['status' => 'success', 'data' => $scoringChart], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/scoring-charts/{id}",
     *     summary="Delete scoring chart",
     *     tags={"ScoringChart"},
     *
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *
     *     @OA\Response(response=200, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $scoringChart = ScoringChart::find($id);

        if (! $scoringChart) {
            return response()->json(['status' => 'error', 'message' => 'Scoring chart not found'], 404);
        }

        $scoringChart->delete();

        return response()->json(['status' => 'success', 'message' => 'Scoring chart deleted successfully'], 200);
    }

    /**
     * @OA\Hidden
     */
    public function create() {}

    /**
     * @OA\Hidden
     */
    public function edit(ScoringChart $scoringChart) {}
}
