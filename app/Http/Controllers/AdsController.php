<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdGetOneRequest;
use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdViewRequest;
use App\Http\Resources\AdCollection;
use App\Http\Resources\AdResource;
use App\Services\AdService;

class AdsController extends Controller
{
    private $service = null;

    public function __construct(AdService $service)
    {
        $this->service = $service;
    }

    public function index(AdViewRequest $request)
    {
        return new AdCollection($this->service->index($request->all(), $request->query()));
    }

    public function get(AdGetOneRequest $request)
    {
        return new AdResource($this->service->get($request->all()));
    }

    public function store(AdStoreRequest $request)
    {
        return response()->json(['data' => $this->service->store($request->all())], 201);
    }
}
