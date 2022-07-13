<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdGetOneRequest;
use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdViewRequest;
use App\Services\AdService;
use App\Services\Utils\DateGenerator;

class AdsController extends Controller
{
    public function index(AdViewRequest $request): \Illuminate\Http\JsonResponse
    {
        return AdService::make($request)->index()->toJsonResponse();
    }

    public function get(AdGetOneRequest $request): \Illuminate\Http\JsonResponse
    {
        return AdService::make($request)->get()->toJsonResponse();
    }

    public function store(AdStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        return  AdService::make($request)->store()->toJsonResponse();
    }
}
