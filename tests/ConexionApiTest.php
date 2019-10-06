<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConexionApiTest extends TestCase
{
    use MakeConexionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateConexion()
    {
        $conexion = $this->fakeConexionData();
        $this->json('POST', '/api/v1/conexions', $conexion);

        $this->assertApiResponse($conexion);
    }

    /**
     * @test
     */
    public function testReadConexion()
    {
        $conexion = $this->makeConexion();
        $this->json('GET', '/api/v1/conexions/'.$conexion->id);

        $this->assertApiResponse($conexion->toArray());
    }

    /**
     * @test
     */
    public function testUpdateConexion()
    {
        $conexion = $this->makeConexion();
        $editedConexion = $this->fakeConexionData();

        $this->json('PUT', '/api/v1/conexions/'.$conexion->id, $editedConexion);

        $this->assertApiResponse($editedConexion);
    }

    /**
     * @test
     */
    public function testDeleteConexion()
    {
        $conexion = $this->makeConexion();
        $this->json('DELETE', '/api/v1/conexions/'.$conexion->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/conexions/'.$conexion->id);

        $this->assertResponseStatus(404);
    }
}
