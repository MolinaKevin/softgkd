<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FamiliaApiTest extends TestCase
{
    use MakeFamiliaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFamilia()
    {
        $familia = $this->fakeFamiliaData();
        $this->json('POST', '/api/v1/familias', $familia);

        $this->assertApiResponse($familia);
    }

    /**
     * @test
     */
    public function testReadFamilia()
    {
        $familia = $this->makeFamilia();
        $this->json('GET', '/api/v1/familias/'.$familia->id);

        $this->assertApiResponse($familia->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFamilia()
    {
        $familia = $this->makeFamilia();
        $editedFamilia = $this->fakeFamiliaData();

        $this->json('PUT', '/api/v1/familias/'.$familia->id, $editedFamilia);

        $this->assertApiResponse($editedFamilia);
    }

    /**
     * @test
     */
    public function testDeleteFamilia()
    {
        $familia = $this->makeFamilia();
        $this->json('DELETE', '/api/v1/familias/'.$familia->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/familias/'.$familia->id);

        $this->assertResponseStatus(404);
    }
}
