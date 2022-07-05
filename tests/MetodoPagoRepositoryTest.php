<?php

use App\Models\MetodoPago;
use App\Repositories\MetodoPagoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MetodoPagoRepositoryTest extends TestCase
{
    use MakeMetodoPagoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MetodoPagoRepository
     */
    protected $metodoPagoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->metodoPagoRepo = App::make(MetodoPagoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMetodoPago()
    {
        $metodoPago = $this->fakeMetodoPagoData();
        $createdMetodoPago = $this->metodoPagoRepo->create($metodoPago);
        $createdMetodoPago = $createdMetodoPago->toArray();
        $this->assertArrayHasKey('id', $createdMetodoPago);
        $this->assertNotNull($createdMetodoPago['id'], 'Created MetodoPago must have id specified');
        $this->assertNotNull(MetodoPago::find($createdMetodoPago['id']), 'MetodoPago with given id must be in DB');
        $this->assertModelData($metodoPago, $createdMetodoPago);
    }

    /**
     * @test read
     */
    public function testReadMetodoPago()
    {
        $metodoPago = $this->makeMetodoPago();
        $dbMetodoPago = $this->metodoPagoRepo->find($metodoPago->id);
        $dbMetodoPago = $dbMetodoPago->toArray();
        $this->assertModelData($metodoPago->toArray(), $dbMetodoPago);
    }

    /**
     * @test update
     */
    public function testUpdateMetodoPago()
    {
        $metodoPago = $this->makeMetodoPago();
        $fakeMetodoPago = $this->fakeMetodoPagoData();
        $updatedMetodoPago = $this->metodoPagoRepo->update($fakeMetodoPago, $metodoPago->id);
        $this->assertModelData($fakeMetodoPago, $updatedMetodoPago->toArray());
        $dbMetodoPago = $this->metodoPagoRepo->find($metodoPago->id);
        $this->assertModelData($fakeMetodoPago, $dbMetodoPago->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMetodoPago()
    {
        $metodoPago = $this->makeMetodoPago();
        $resp = $this->metodoPagoRepo->delete($metodoPago->id);
        $this->assertTrue($resp);
        $this->assertNull(MetodoPago::find($metodoPago->id), 'MetodoPago should not exist in DB');
    }
}
