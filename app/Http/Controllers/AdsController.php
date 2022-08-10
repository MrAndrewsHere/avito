<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdGetOneRequest;
use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdViewRequest;
use App\Services\AdService;

class AdsController extends Controller
{
    public function index(AdViewRequest $request, AdService $service): \Illuminate\Http\JsonResponse
    {
        return $service->index($request)->toJsonResponse();
    }

    public function get(AdGetOneRequest $request, AdService $service): \Illuminate\Http\JsonResponse
    {
        return $service->get($request)->toJsonResponse();
    }

    public function store(AdStoreRequest $request, AdService $service): \Illuminate\Http\JsonResponse
    {
        return $service->store($request)->toJsonResponse();
    }
}
