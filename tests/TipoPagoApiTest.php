<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TipoPagoApiTest extends TestCase
{
    use MakeTipoPagoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTipoPago()
    {
        $tipoPago = $this->fakeTipoPagoData();
        $this->json('POST', '/api/v1/tipoPagos', $tipoPago);

        $this->assertApiResponse($tipoPago);
    }

    /**
     * @test
     */
    public function testReadTipoPago()
    {
        $tipoPago = $this->makeTipoPago();
        $this->json('GET', '/api/v1/tipoPagos/'.$tipoPago->id);

        $this->assertApiResponse($tipoPago->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTipoPago()
    {
        $tipoPago = $this->makeTipoPago();
        $editedTipoPago = $this->fakeTipoPagoData();

        $this->json('PUT', '/api/v1/tipoPagos/'.$tipoPago->id, $editedTipoPago);

        $this->assertApiResponse($editedTipoPago);
    }

    /**
     * @test
     */
    public function testDeleteTipoPago()
    {
        $tipoPago = $this->makeTipoPago();
        $this->json('DELETE', '/api/v1/tipoPagos/'.$tipoPago->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tipoPagos/'.$tipoPago->id);

        $this->assertResponseStatus(404);
    }
}
