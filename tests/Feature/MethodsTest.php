<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
class MethodsTest extends TestCase
{
    /**
     * @return void
     */
    public function test_create_method_success(): void
    {
        $postData = [
            [
                'route'=>'/route/test/1',
                'method'=>'',
            ],
            [
                'route'=>'',
                'method'=>'/route/test/1',
            ],
            [
                'route'=>'/route/test/1',
                'method'=>'MyMethod1',
            ],
            [
                'route'=>'/route/test/1',
                'method'=>null,
            ],
            [
                'route'=>null,
                'method'=>'MyMethod1',
            ],
        ];
        foreach ($postData as $data) {
            $this->json('POST', 'api/method', $data)
                ->assertJson(function(AssertableJson $json){
                    $json->etc();
                })
                ->assertStatus(201);
        }
    }

    /**
     * @return void
     */
    public function test_create_method_unsuccess(): void
    {
        $postData = [
            [
                'route'=>null,
                'method'=>null,
            ],
        ];
        foreach ($postData as $data) {
            $this->json('POST', 'api/method', $data)
                ->assertJson(function(AssertableJson $json){
                    $json->etc();
                })
                ->assertStatus(422);
        }
    }


}
