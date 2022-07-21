<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CajaApiTest extends TestCase
{
    use MakeCajaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCaja()
    {
        $caja = $this->fakeCajaData();
        $this->json('POST', '/api/v1/cajas', $caja);

        $this->assertApiResponse($caja);
    }

    /**
     * @test
     */
    public function testReadCaja()
    {
        $caja = $this->makeCaja();
        $this->json('GET', '/api/v1/cajas/'.$caja->id);

        $this->assertApiResponse($caja->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCaja()
    {
        $caja = $this->makeCaja();
        $editedCaja = $this->fakeCajaData();

        $this->json('PUT', '/api/v1/cajas/'.$caja->id, $editedCaja);

        $this->assertApiResponse($editedCaja);
    }

    /**
     * @test
     */
    public function testDeleteCaja()
    {
        $caja = $this->makeCaja();
        $this->json('DELETE', '/api/v1/cajas/'.$caja->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/cajas/'.$caja->id);

        $this->assertResponseStatus(404);
    }
}
