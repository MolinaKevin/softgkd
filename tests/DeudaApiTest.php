<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeudaApiTest extends TestCase
{
    use MakeDeudaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDeuda()
    {
        $deuda = $this->fakeDeudaData();
        $this->json('POST', '/api/v1/deudas', $deuda);

        $this->assertApiResponse($deuda);
    }

    /**
     * @test
     */
    public function testReadDeuda()
    {
        $deuda = $this->makeDeuda();
        $this->json('GET', '/api/v1/deudas/'.$deuda->id);

        $this->assertApiResponse($deuda->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDeuda()
    {
        $deuda = $this->makeDeuda();
        $editedDeuda = $this->fakeDeudaData();

        $this->json('PUT', '/api/v1/deudas/'.$deuda->id, $editedDeuda);

        $this->assertApiResponse($editedDeuda);
    }

    /**
     * @test
     */
    public function testDeleteDeuda()
    {
        $deuda = $this->makeDeuda();
        $this->json('DELETE', '/api/v1/deudas/'.$deuda->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/deudas/'.$deuda->id);

        $this->assertResponseStatus(404);
    }
}
