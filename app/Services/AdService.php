<?php

namespace App\Services;

use App\Models\Ads;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AdService
{
    private $request = null;
    private $input = null;
    private $output = [];
    private $statusCode = 200;


    public static function make(): AdService
    {
        return new self(...func_get_args());
    }

    public function __construct($request)
    {
        $this->request = $request;
        $this->input = $request->all();
    }

    public function index(): AdService
    {
        $this->output = Ads::with(['preview'])
            ->view()
            ->sorted($this->input['sortBy'] ?? null, $this->input['sortVal'] ?? null)
            ->paginate(10)->appends($this->request->query());
        return $this;
    }

    public function get(): AdService
    {
        $this->output = Ads::with(['photo', 'preview'])
            ->find($this->input['id'])
            ->only(array_merge(['id', 'preview', 'cost'], $this->input['fields'] ?? []));
        return $this;
    }

    public function store(): AdService
    {
        $this->output = DB::transaction(function () {
            $ad = Ads::create($this->input);
            if ($this->input['photo']['0']['url'] ?? false) {
                collect($this->input['photo'])->each(fn($photo) => $ad->photo()->save(Photo::make($photo)));
            }
            return $ad->only('id');
        });
        $this->statusCode = 201;
        return $this;
    }


    public function toJsonResponse(): JsonResponse
    {
        return new JsonResponse(['data' => $this->output], $this->statusCode);
    }

}

