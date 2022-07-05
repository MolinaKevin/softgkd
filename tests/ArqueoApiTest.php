<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArqueoApiTest extends TestCase
{
    use MakeArqueoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateArqueo()
    {
        $arqueo = $this->fakeArqueoData();
        $this->json('POST', '/api/v1/arqueos', $arqueo);

        $this->assertApiResponse($arqueo);
    }

    /**
     * @test
     */
    public function testReadArqueo()
    {
        $arqueo = $this->makeArqueo();
        $this->json('GET', '/api/v1/arqueos/'.$arqueo->id);

        $this->assertApiResponse($arqueo->toArray());
    }

    /**
     * @test
     */
    public function testUpdateArqueo()
    {
        $arqueo = $this->makeArqueo();
        $editedArqueo = $this->fakeArqueoData();

        $this->json('PUT', '/api/v1/arqueos/'.$arqueo->id, $editedArqueo);

        $this->assertApiResponse($editedArqueo);
    }

    /**
     * @test
     */
    public function testDeleteArqueo()
    {
        $arqueo = $this->makeArqueo();
        $this->json('DELETE', '/api/v1/arqueos/'.$arqueo->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/arqueos/'.$arqueo->id);

        $this->assertResponseStatus(404);
    }
}
