<?php

namespace Tests\util;

use Illuminate\Support\Arr;

trait BrokeValidationTrait
{

    public function assertPost($validatedField, $brokenRule, $expectedField = null): \Illuminate\Foundation\Testing\TestResponse
    {
        $expectedField = $expectedField ?? $validatedField;
        $data = $this->data;
        if ($this->model) {
            array_merge($data, $this->model::factory()->make()->toArray());
        }
        Arr::set($data, $validatedField, $brokenRule);
        $res = $this->postJson($this->url, $data);
        $res->assertJsonValidationErrors($expectedField);
        return $res;
    }

    public function assertGet($validatedField, $brokenRule, $expectedField = null): \Illuminate\Foundation\Testing\TestResponse
    {
        $expectedField = $expectedField ?? $validatedField;
        $data = $this->data;
        Arr::set($data, $validatedField, $brokenRule);
        $res = $this->getJson($this->url . '?' . http_build_query($data));
        $res->assertJsonValidationErrors($expectedField);
        return $res;
    }
}
