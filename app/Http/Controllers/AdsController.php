<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdGetOneRequest;
use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdViewRequest;
use App\Services\AdService;

class AdsController extends Controller
{
    public function index(AdViewRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new AdService($request))->index()->toJsonResponse();
    }

    public function get(AdGetOneRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new AdService($request))->get()->toJsonResponse();
    }

    public function store(AdStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new AdService($request))->store()->toJsonResponse();
    }
}
