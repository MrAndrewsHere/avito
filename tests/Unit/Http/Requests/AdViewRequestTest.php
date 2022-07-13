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
        'sortVal' => 'desc'
    ];

    /** @test */
    public function sort_filed_required()
    {
        $this->assertGet('sortBy', null);
    }

    /** @test */
    public function sortVal_filed_required()
    {
        $this->assertGet('sortVal', null);
    }

    /** @test */
    public function sortBy_filed_in_array()
    {
        $this->assertGet('sortBy','test');
    }

    /** @test */
    public function sortVal_filed_in_array()
    {
        $this->assertGet('sortVal','test');
    }


}
