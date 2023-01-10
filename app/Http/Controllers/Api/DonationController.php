<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequest;
use App\Models\Donation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(DonationRequest $request): JsonResponse
    {
        return response()->json($this->getSuccessResponse(Donation::create($request->all())));
    }

    public function index(): JsonResponse
    {
        return response()->json($this->getSuccessResponse(Donation::query()->with('campaign')->get()));
    }
}
