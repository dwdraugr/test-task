<?php

namespace App\Http\Controllers;

use App\Http\Resources\WnfDataCollection;
use App\Models\WnfData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WnfDataController extends Controller
{
    public function index(Request $request): WnfDataCollection
    {
        $conditions = $this->createConditions($request);
        return new WnfDataCollection(WnfData::where($conditions)->paginate(25));
    }

    public function show(string $uuid): JsonResponse
    {
        return response()->json(WnfData::findOrFail($uuid));
    }

    protected function createConditions(Request $request)
    {
        $condition = [];
        if (($isPharmacyManufacturing = $request->get('is_pharmacy_manufacturing'))) {
            $condition[] = ['is_pharmacy_manufacturing', $isPharmacyManufacturing];
        }
        if (($isVerified = $request->get('is_verified'))) {
            $condition[] = ['is_verified', $isVerified];
        }
        if (($typeId = $request->get('type_id'))) {
            $condition[] = ['type_id', $typeId];
        }
        if (($statusId = $request->get('status_id'))) {
            $condition[] = ['status_id', $statusId];
        }
        return $condition;
    }
}
