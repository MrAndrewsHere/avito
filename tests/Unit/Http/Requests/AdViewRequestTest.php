<?php

namespace Http\Requests;
use Tests\RequestTest;
use Tests\util\BrokeValidationTrait;

class AdViewRequestTest extends RequestTest
{
    use BrokeValidationTrait;

    protected string $url = '/api/v1/ads';
    protected string $method = 'get';
    protected $data = [
        'sortBy' => 'price',
        'descending' => false
    ];


    /** @test */
    public function sortBy_filed_in_array()
    {
        $this->assertGet('sortBy','test');
    }



}
