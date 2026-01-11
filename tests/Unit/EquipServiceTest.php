<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\EquipService;
use App\Repositories\EquipRepositoryInterface;
use Mockery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EquipServiceTest extends TestCase
{
    public function test_create_equip_calls_repository()
    {
        // 1. PREPARAR
        $repositoryMock = Mockery::mock(EquipRepositoryInterface::class);

        $data = [
            'nom' => 'Equip de Prova',
            'ciutat' => 'València',
            'lliga' => 'Femenina'
        ];

        $repositoryMock->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn((object) $data);

        $service = new EquipService($repositoryMock);

        // 2. ACTUAR
        $result = $service->create($data);

        // 3. VERIFICAR
        $this->assertEquals('Equip de Prova', $result->nom);
    }

    public function test_create_equip_with_image_uploads_file()
    {
        // 1. PREPARAR
        Storage::fake('public'); // Disco falso

        $repositoryMock = Mockery::mock(EquipRepositoryInterface::class);

        $file = UploadedFile::fake()->image('escut.jpg');

        $data = [
            'nom' => 'Equip amb Foto',
            'escut' => $file
        ];

        // Simulamos que el repositorio recibe la ruta correcta
        $repositoryMock->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($argument) {
                return is_string($argument['escut']) && str_contains($argument['escut'], 'escut');
            }))
            ->andReturn((object) ['nom' => 'Equip amb Foto']);

        $service = new EquipService($repositoryMock);

        // 2. ACTUAR
        $service->create($data);

        // 3. VERIFICAR
        // Usamos assertTrue + exists, que es más compatible y seguro
        $this->assertTrue(
            Storage::disk('public')->exists('escuts/' . $file->hashName()),
            "El fitxer no s'ha trobat al disc 'public'"
        );
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
