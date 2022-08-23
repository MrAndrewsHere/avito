<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;

class AdService
{
    public function index($data, $requestQuery)
    {
        return Ad::forCollection()
            ->sorted($data['sortBy'] ?? null, $data['descending'] ?? false)
            ->paginate(10)
            ->appends($requestQuery);
    }

    public function get($data)
    {
        return Ad::find($data['id']);
    }

    public function store($data): array
    {
        return DB::transaction(function () use ($data) {
            $ad = Ad::create($data);
            if (isset($data['photo'])) {
                $ad->photo()->createMany($data['photo']);
            }
            return $ad->only('id');
        });
    }
}

