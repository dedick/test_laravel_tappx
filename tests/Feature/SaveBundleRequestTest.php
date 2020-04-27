<?php

namespace Tests\Feature;

use App\Models\Bundle;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SaveBundleRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
    }

    public function testRequestShouldFailWhenNoNameIsProvided()
    {
        $response = $this->json('POST', '/api/bundle', ['bundle' => 'com.package.example']);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        )->assertJson([
            'status' => 'KO',
            'data' => [
                'name' => [
                    'The name field is required.'
                ],
            ]
        ]);
    }

    public function testRequestShouldFailWhenNoBundleIsProvided()
    {
        $response = $this->json('POST', '/api/bundle', ['name' => 'android']);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        )->assertJson([
            'status' => 'KO',
            'data' => [
                'bundle' => [
                    'The bundle field is required.'
                ],
            ]
        ]);
    }

    public function testRequestShouldSuccessWhenNoBundleIsProvided()
    {
        $response = $this->json('POST', '/api/bundle', [
            'name' => 'android',
            'bundle' => 'com.example.app'
        ]);
        $response->assertStatus(
            Response::HTTP_OK
        )->assertJsonStructure(['status', 'data' => ['name', 'bundle', 'id', 'updated_at', 'created_at']]);
    }
}
