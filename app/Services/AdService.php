<?php

namespace App\Services;

use App\Http\Requests\AdGetOneRequest;
use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdViewRequest;
use App\Models\Ads;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AdService
{
    private $output = null;
    private $statusCode = 200;

    public function index(AdViewRequest $request): AdService
    {
        $this->output = Ads::with(['preview'])
            ->view()
            ->sorted($request->get('sortBy') ?? null, $request->get('descending') ?? false)
            ->paginate(10)->appends($request->query());
        return $this;
    }

    public function get(AdGetOneRequest $request): AdService
    {
        $this->output = Ads::with(['photo', 'preview'])
            ->find($request->get('id'))
            ->only(array_merge(['id', 'preview', 'price','name'], $request->get('fields') ?? []));
        return $this;
    }

    public function store(AdStoreRequest $request): AdService
    {
        $this->output = DB::transaction(function () use ($request) {
            $ad = Ads::create($request->all());

            if ($request->has('photo')) {
                collect($request->get('photo'))->each(fn($photo) => $ad->photo()->save(Photo::make($photo)));
            }
            return $ad->only('id');
        });
        $this->statusCode = 201;
        return $this;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return null
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @return JsonResponse
     */
    public function toJsonResponse(): JsonResponse
    {
        return new JsonResponse(['data' => $this->getOutput()], $this->statusCode);
    }

}

