<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MovimientoApiTest extends TestCase
{
    use MakeMovimientoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMovimiento()
    {
        $movimiento = $this->fakeMovimientoData();
        $this->json('POST', '/api/v1/movimientos', $movimiento);

        $this->assertApiResponse($movimiento);
    }

    /**
     * @test
     */
    public function testReadMovimiento()
    {
        $movimiento = $this->makeMovimiento();
        $this->json('GET', '/api/v1/movimientos/'.$movimiento->id);

        $this->assertApiResponse($movimiento->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMovimiento()
    {
        $movimiento = $this->makeMovimiento();
        $editedMovimiento = $this->fakeMovimientoData();

        $this->json('PUT', '/api/v1/movimientos/'.$movimiento->id, $editedMovimiento);

        $this->assertApiResponse($editedMovimiento);
    }

    /**
     * @test
     */
    public function testDeleteMovimiento()
    {
        $movimiento = $this->makeMovimiento();
        $this->json('DELETE', '/api/v1/movimientos/'.$movimiento->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/movimientos/'.$movimiento->id);

        $this->assertResponseStatus(404);
    }
}
