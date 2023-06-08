<?php

use App\Models\TipoPago;
use App\Repositories\TipoPagoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TipoPagoRepositoryTest extends TestCase
{
    use MakeTipoPagoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoPagoRepository
     */
    protected $tipoPagoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->tipoPagoRepo = App::make(TipoPagoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTipoPago()
    {
        $tipoPago = $this->fakeTipoPagoData();
        $createdTipoPago = $this->tipoPagoRepo->create($tipoPago);
        $createdTipoPago = $createdTipoPago->toArray();
        $this->assertArrayHasKey('id', $createdTipoPago);
        $this->assertNotNull($createdTipoPago['id'], 'Created TipoPago must have id specified');
        $this->assertNotNull(TipoPago::find($createdTipoPago['id']), 'TipoPago with given id must be in DB');
        $this->assertModelData($tipoPago, $createdTipoPago);
    }

    /**
     * @test read
     */
    public function testReadTipoPago()
    {
        $tipoPago = $this->makeTipoPago();
        $dbTipoPago = $this->tipoPagoRepo->find($tipoPago->id);
        $dbTipoPago = $dbTipoPago->toArray();
        $this->assertModelData($tipoPago->toArray(), $dbTipoPago);
    }

    /**
     * @test update
     */
    public function testUpdateTipoPago()
    {
        $tipoPago = $this->makeTipoPago();
        $fakeTipoPago = $this->fakeTipoPagoData();
        $updatedTipoPago = $this->tipoPagoRepo->update($fakeTipoPago, $tipoPago->id);
        $this->assertModelData($fakeTipoPago, $updatedTipoPago->toArray());
        $dbTipoPago = $this->tipoPagoRepo->find($tipoPago->id);
        $this->assertModelData($fakeTipoPago, $dbTipoPago->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTipoPago()
    {
        $tipoPago = $this->makeTipoPago();
        $resp = $this->tipoPagoRepo->delete($tipoPago->id);
        $this->assertTrue($resp);
        $this->assertNull(TipoPago::find($tipoPago->id), 'TipoPago should not exist in DB');
    }
}
