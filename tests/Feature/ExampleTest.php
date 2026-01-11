<?php

namespace Tests\Feature;

// 1. Descomenta o añade esta línea
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // 2. Añade esto dentro de la clase para que cree las tablas
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/equips');

        $response->assertStatus(200);
    }
}
