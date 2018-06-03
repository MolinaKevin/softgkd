<?php

use App\Models\Dispositivo;
use App\Repositories\DispositivoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DispositivoRepositoryTest extends TestCase
{
    use MakeDispositivoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DispositivoRepository
     */
    protected $dispositivoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->dispositivoRepo = App::make(DispositivoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDispositivo()
    {
        $dispositivo = $this->fakeDispositivoData();
        $createdDispositivo = $this->dispositivoRepo->create($dispositivo);
        $createdDispositivo = $createdDispositivo->toArray();
        $this->assertArrayHasKey('id', $createdDispositivo);
        $this->assertNotNull($createdDispositivo['id'], 'Created Dispositivo must have id specified');
        $this->assertNotNull(Dispositivo::find($createdDispositivo['id']), 'Dispositivo with given id must be in DB');
        $this->assertModelData($dispositivo, $createdDispositivo);
    }

    /**
     * @test read
     */
    public function testReadDispositivo()
    {
        $dispositivo = $this->makeDispositivo();
        $dbDispositivo = $this->dispositivoRepo->find($dispositivo->id);
        $dbDispositivo = $dbDispositivo->toArray();
        $this->assertModelData($dispositivo->toArray(), $dbDispositivo);
    }

    /**
     * @test update
     */
    public function testUpdateDispositivo()
    {
        $dispositivo = $this->makeDispositivo();
        $fakeDispositivo = $this->fakeDispositivoData();
        $updatedDispositivo = $this->dispositivoRepo->update($fakeDispositivo, $dispositivo->id);
        $this->assertModelData($fakeDispositivo, $updatedDispositivo->toArray());
        $dbDispositivo = $this->dispositivoRepo->find($dispositivo->id);
        $this->assertModelData($fakeDispositivo, $dbDispositivo->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDispositivo()
    {
        $dispositivo = $this->makeDispositivo();
        $resp = $this->dispositivoRepo->delete($dispositivo->id);
        $this->assertTrue($resp);
        $this->assertNull(Dispositivo::find($dispositivo->id), 'Dispositivo should not exist in DB');
    }
}
