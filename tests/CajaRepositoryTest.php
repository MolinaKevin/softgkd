<?php

use App\Models\Caja;
use App\Repositories\CajaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CajaRepositoryTest extends TestCase
{
    use MakeCajaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CajaRepository
     */
    protected $cajaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->cajaRepo = App::make(CajaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCaja()
    {
        $caja = $this->fakeCajaData();
        $createdCaja = $this->cajaRepo->create($caja);
        $createdCaja = $createdCaja->toArray();
        $this->assertArrayHasKey('id', $createdCaja);
        $this->assertNotNull($createdCaja['id'], 'Created Caja must have id specified');
        $this->assertNotNull(Caja::find($createdCaja['id']), 'Caja with given id must be in DB');
        $this->assertModelData($caja, $createdCaja);
    }

    /**
     * @test read
     */
    public function testReadCaja()
    {
        $caja = $this->makeCaja();
        $dbCaja = $this->cajaRepo->find($caja->id);
        $dbCaja = $dbCaja->toArray();
        $this->assertModelData($caja->toArray(), $dbCaja);
    }

    /**
     * @test update
     */
    public function testUpdateCaja()
    {
        $caja = $this->makeCaja();
        $fakeCaja = $this->fakeCajaData();
        $updatedCaja = $this->cajaRepo->update($fakeCaja, $caja->id);
        $this->assertModelData($fakeCaja, $updatedCaja->toArray());
        $dbCaja = $this->cajaRepo->find($caja->id);
        $this->assertModelData($fakeCaja, $dbCaja->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCaja()
    {
        $caja = $this->makeCaja();
        $resp = $this->cajaRepo->delete($caja->id);
        $this->assertTrue($resp);
        $this->assertNull(Caja::find($caja->id), 'Caja should not exist in DB');
    }
}
