<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PregnancyRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * @OA\Tag(
 *     name="Pregnancy Records",
 *     description="API for managing pregnancy records"
 * )
 */
class PregnancyRecordController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/pregnancy-records",
     *     summary="List all pregnancy records",
     *     tags={"Pregnancy Records"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return response()->json(PregnancyRecord::all());
    }

    /**
     * @OA\Post(
     *     path="/api/pregnancy-records",
     *     summary="Create a new pregnancy record",
     *     tags={"Pregnancy Records"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PregnancyRecord")
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=422, description="Validation failed")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'obstetric_sheet_id' => ['required', 'exists:obstetric_sheets,id'],
            'pregnancy_order' => ['required', 'string'],
            'aog' => ['nullable', 'string'],
            'manner_of_delivery' => ['nullable', 'string'],
            'place_of_delivery' => ['nullable', 'string'],
            'gender' => ['nullable', Rule::in(['Male', 'Female'])],
            'weight' => ['nullable', 'string'],
            'complications' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $record = PregnancyRecord::create($validator->validated());
        return response()->json($record, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/pregnancy-records/{id}",
     *     summary="Get a single pregnancy record",
     *     tags={"Pregnancy Records"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $record = PregnancyRecord::find($id);
        if (!$record) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($record);
    }

    /**
     * @OA\Put(
     *     path="/api/pregnancy-records/{id}",
     *     summary="Update a pregnancy record",
     *     tags={"Pregnancy Records"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PregnancyRecord")
     *     ),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=422, description="Validation failed")
     * )
     */
    public function update(Request $request, $id)
    {
        $record = PregnancyRecord::find($id);
        if (!$record) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'obstetric_sheet_id' => ['sometimes', 'exists:obstetric_sheets,id'],
            'pregnancy_order' => ['sometimes', 'string'],
            'aog' => ['nullable', 'string'],
            'manner_of_delivery' => ['nullable', 'string'],
            'place_of_delivery' => ['nullable', 'string'],
            'gender' => ['nullable', Rule::in(['Male', 'Female'])],
            'weight' => ['nullable', 'string'],
            'complications' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $record->update($validator->validated());
        return response()->json($record);
    }

    /**
     * @OA\Delete(
     *     path="/api/pregnancy-records/{id}",
     *     summary="Delete a pregnancy record",
     *     tags={"Pregnancy Records"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $record = PregnancyRecord::find($id);
        if (!$record) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        $record->delete();
        return response()->json(null, 204);
    }
}
