<?php

namespace Http\Requests;

use App\Models\Ads;

use Illuminate\Support\Arr;
use Tests\RequestTest;
use Tests\util\BrokeValidationTrait;

class AdGetOneRequestTest extends RequestTest
{


    use BrokeValidationTrait;

    protected string $url = '/api/v1/ad';
    protected string $method = 'get';
    protected $data = [
        'id' => 1,
        'fields' => ['photo', 'description']
    ];

    /** @test */
    public function id_filed_required()
    {
        $this->assertGet('id', null);
    }

    /** @test */
    public function id_filed_exist()
    {
        $this->assertGet('id', 0);
    }

    /** @test */
    public function fields_filed_is_array()
    {
        Arr::set($this->data, 'id', Ads::factory()->create()->id);
        $this->assertGet('fields', '');
    }

    /** @test */
    public function fields_filed_in_array()
    {
        Arr::set($this->data, 'id', Ads::factory()->create()->id);
        $this->assertGet('fields', ['photo', 'password'], 'fields.1');
    }


}
