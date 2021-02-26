<?php

namespace Tests;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function create(string $model,array $attributes=[]){
        $response = factory("App\\Http\\Models\\$model")->create($attributes);
        $recourceModel = "App\\Http\\Resources\\$model"."Resource";
        return $recourceModel::Collection($response->get());

    }

}
