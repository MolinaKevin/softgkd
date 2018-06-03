<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DispositivoApiTest extends TestCase
{
    use MakeDispositivoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDispositivo()
    {
        $dispositivo = $this->fakeDispositivoData();
        $this->json('POST', '/api/v1/dispositivos', $dispositivo);

        $this->assertApiResponse($dispositivo);
    }

    /**
     * @test
     */
    public function testReadDispositivo()
    {
        $dispositivo = $this->makeDispositivo();
        $this->json('GET', '/api/v1/dispositivos/'.$dispositivo->id);

        $this->assertApiResponse($dispositivo->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDispositivo()
    {
        $dispositivo = $this->makeDispositivo();
        $editedDispositivo = $this->fakeDispositivoData();

        $this->json('PUT', '/api/v1/dispositivos/'.$dispositivo->id, $editedDispositivo);

        $this->assertApiResponse($editedDispositivo);
    }

    /**
     * @test
     */
    public function testDeleteDispositivo()
    {
        $dispositivo = $this->makeDispositivo();
        $this->json('DELETE', '/api/v1/dispositivos/'.$dispositivo->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/dispositivos/'.$dispositivo->id);

        $this->assertResponseStatus(404);
    }
}
