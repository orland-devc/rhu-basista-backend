<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="PregnancyRecord",
 *     type="object",
 *     title="Pregnancy Record",
 *     required={"obstetric_sheet_id", "pregnancy_order"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="obstetric_sheet_id", type="integer", example=1),
 *     @OA\Property(property="pregnancy_order", type="string", example="G1"),
 *     @OA\Property(property="aog", type="string", example="39 weeks"),
 *     @OA\Property(property="manner_of_delivery", type="string", example="Normal Spontaneous Delivery"),
 *     @OA\Property(property="place_of_delivery", type="string", example="Rural Health Unit"),
 *     @OA\Property(property="gender", type="string", example="Female"),
 *     @OA\Property(property="weight", type="string", example="3.2 kg"),
 *     @OA\Property(property="complications", type="string", example="None"),
 *     @OA\Property(property="status", type="string", example="Alive")
 * )
 */
class PregnancyRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'obstetric_sheet_id',
        'pregnancy_order',
        'aog',
        'manner_of_delivery',
        'place_of_delivery',
        'gender',
        'weight',
        'complications',
        'status',
    ];

    public function obstetricSheet()
    {
        return $this->belongsTo(ObstetricSheet::class);
    }
}
