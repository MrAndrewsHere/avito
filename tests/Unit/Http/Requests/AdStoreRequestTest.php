<?php

namespace Tests\Unit\Http\Requests;

use App\Models\Ads;
use Illuminate\Support\Str;
use Tests\RequestTest;


class AdStoreRequestTest extends RequestTest
{
    protected string $url = '/api/v1/ad';
    protected $model = Ads::class;
    protected string $method = 'post';

    /** @test */
    public function name_filed_required()
    {
        $this->assertPost('name', null);
    }

    /** @test */
    public function name_filed_max_string()
    {
        $this->assertPost('name', Str::random(201));
    }

    /** @test */
    public function name_filed_min_string()
    {
        $this->assertPost('name', Str::random(4));
    }

    /** @test */
    public function description_filed_max_string()
    {
        $this->assertPost('description', Str::random(1001));
    }

    /** @test */
    public function price_filed_required()
    {
        $this->assertPost('price', null);
    }

    /** @test */
    public function price_filed_numeric()
    {
        $this->assertPost('price', 's');
    }


    /** @test */
    public function photo_filed_array()
    {
        $this->assertPost('photo', '');
    }

    /** @test */
    public function photo_filed_max_length()
    {
        $this->assertPost('photo', [1, 1, 1, 1]);
    }

    /** @test */
    public function photo_filed_url()
    {
        $this->assertPost('photo.0.url', [['url' => 1]]);
    }

    /** @test */
    public function photo_filed_url_distinct()
    {
        $this->assertPost('photo',
            [['url' => 'https://url.ru'], ['url' => 'https://url.ru']], 'photo.0.url');
    }
}
