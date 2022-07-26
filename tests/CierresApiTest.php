<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CierresApiTest extends TestCase
{
    use MakeCierresTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCierres()
    {
        $cierres = $this->fakeCierresData();
        $this->json('POST', '/api/v1/cierres', $cierres);

        $this->assertApiResponse($cierres);
    }

    /**
     * @test
     */
    public function testReadCierres()
    {
        $cierres = $this->makeCierres();
        $this->json('GET', '/api/v1/cierres/'.$cierres->id);

        $this->assertApiResponse($cierres->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCierres()
    {
        $cierres = $this->makeCierres();
        $editedCierres = $this->fakeCierresData();

        $this->json('PUT', '/api/v1/cierres/'.$cierres->id, $editedCierres);

        $this->assertApiResponse($editedCierres);
    }

    /**
     * @test
     */
    public function testDeleteCierres()
    {
        $cierres = $this->makeCierres();
        $this->json('DELETE', '/api/v1/cierres/'.$cierres->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/cierres/'.$cierres->id);

        $this->assertResponseStatus(404);
    }
}
