<?php

namespace Tests\Feature\Api;


use Tests\TestCase;

class CategoryApiTest extends TestCase
{

    protected $endpoint = '/api/categories';

    public function test_list_empty_categories()
    {
        $response = $this->getJson($this->endpoint);

        $response->assertStatus(200);
        $response->assertJsonCount(0, 'data');
    }
}
