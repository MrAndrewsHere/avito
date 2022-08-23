<?php

namespace Tests;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\util\BrokeValidationTrait;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    use BrokeValidationTrait;

    protected $data = [];
    protected $model = null;
    protected $method = 'get';

}
