<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MetodoPagoApiTest extends TestCase
{
    use MakeMetodoPagoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMetodoPago()
    {
        $metodoPago = $this->fakeMetodoPagoData();
        $this->json('POST', '/api/v1/metodoPagos', $metodoPago);

        $this->assertApiResponse($metodoPago);
    }

    /**
     * @test
     */
    public function testReadMetodoPago()
    {
        $metodoPago = $this->makeMetodoPago();
        $this->json('GET', '/api/v1/metodoPagos/'.$metodoPago->id);

        $this->assertApiResponse($metodoPago->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMetodoPago()
    {
        $metodoPago = $this->makeMetodoPago();
        $editedMetodoPago = $this->fakeMetodoPagoData();

        $this->json('PUT', '/api/v1/metodoPagos/'.$metodoPago->id, $editedMetodoPago);

        $this->assertApiResponse($editedMetodoPago);
    }

    /**
     * @test
     */
    public function testDeleteMetodoPago()
    {
        $metodoPago = $this->makeMetodoPago();
        $this->json('DELETE', '/api/v1/metodoPagos/'.$metodoPago->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/metodoPagos/'.$metodoPago->id);

        $this->assertResponseStatus(404);
    }
}
