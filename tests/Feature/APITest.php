<?php

namespace Tests\Feature;

use App\Models\Ads;
use App\Models\Photo;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class APITest extends TestCase
{

    use RefreshDatabase;

    private string $routePrefix = '/api/v1/';

    /** @test */
    public function test_can_view_ads()
    {
        $count = 31;
        $ads = Ads::factory($count)->create()->each(function ($ad) {
            $ad->photo()->saveMany(Photo::factory(random_int(1, 3))->make());
        });

        collect(['price', 'created_at'])
            ->crossJoin(collect([1,0]))
            ->map(fn($i) => array_combine(['sortBy', 'descending'], array_values($i)))
            ->each(function ($payload) use ($ads, $count) {
                $expected = $ads->sortBy($payload['sortBy'], SORT_REGULAR, !(bool)$payload['descending']  )->take(10)->map(fn($i) => [
                    'id' => $i['id'],
                    'name' => $i['name'],
                    'price' => $i['price'],
                    'preview' => [
                        'id' => $i['preview']['id'],
                        'ad_id' => $i['preview']['ad_id'],
                        'url' => $i['preview']['url'],
                    ],
                ]);
                //С загрузкой через loadMissing не проходит тест

                $response = $this->getJson(
                    $this->routePrefix
                    . 'ads?'
                    . http_build_query(
                        $payload
                    )
                );

                $response->assertOk()->assertJson([
                    'data' => [
                        'current_page' => 1,
                        'last_page' => 4,
                        'per_page' => 10,
                        'total' => $count,
                        'data' => $expected->values()->toArray(),
                    ]
                ]);
            });
    }

    /** @test */
    public function can_get_one_ad()
    {
        $ad = Ads::factory()->create();
        $default = ['id', 'preview', 'price'];
        $optional = ['description', 'photo'];
        $response = $this->getJson(
            $this->routePrefix . 'ad?'
            . http_build_query(
                array_merge($ad->only('id'), ['fields' => $optional])
            )
        );
        $answer = collect(array_merge($default, $optional));
        $response->assertOk()->assertJsonStructure(['data' => $answer->toArray()]);
        $response->assertJson([
            'data' => ['id' => $ad->id]
        ]);
    }

    /**test */
    public function test_can_store_ad()
    {
        $ad = Ads::factory()->make();
        $response = $this->postJson($this->routePrefix . 'ad', array_merge($ad->toArray()));
        $response->assertCreated();
        $response->assertCreated()->assertJsonStructure(['data' => ['id']]);
        $this->assertDatabaseHas('ads', $ad->toArray());
    }

    /**test */
    public function test_can_store_ad_with_photo()
    {
        $ad = Ads::factory()->make();
        $photo = Photo::factory(random_int(1, 3))->make();
        $response = $this->postJson($this->routePrefix . 'ad', array_merge($ad->toArray(), ['photo' => $photo->toArray()]));
        $response->assertCreated()->assertJsonStructure(['data' => ['id']]);
        $this->assertDatabaseHas('ads', $ad->toArray());
        $this->assertDatabaseHas('photo', $photo->first()->toArray());
    }
}
