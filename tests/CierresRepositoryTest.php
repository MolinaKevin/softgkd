<?php

use App\Models\Cierre;
use App\Repositories\CierreRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CierreRepositoryTest extends TestCase
{
    use MakeCierreTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CierreRepository
     */
    protected $cierreRepo;

    public function setUp()
    {
        parent::setUp();
        $this->cierreRepo = App::make(CierreRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCierre()
    {
        $cierre = $this->fakeCierreData();
        $createdCierre = $this->cierreRepo->create($cierre);
        $createdCierre = $createdCierre->toArray();
        $this->assertArrayHasKey('id', $createdCierre);
        $this->assertNotNull($createdCierre['id'], 'Created Cierre must have id specified');
        $this->assertNotNull(Cierre::find($createdCierre['id']), 'Cierre with given id must be in DB');
        $this->assertModelData($cierre, $createdCierre);
    }

    /**
     * @test read
     */
    public function testReadCierre()
    {
        $cierre = $this->makeCierre();
        $dbCierre = $this->cierreRepo->find($cierre->id);
        $dbCierre = $dbCierre->toArray();
        $this->assertModelData($cierre->toArray(), $dbCierre);
    }

    /**
     * @test update
     */
    public function testUpdateCierre()
    {
        $cierre = $this->makeCierre();
        $fakeCierre = $this->fakeCierreData();
        $updatedCierre = $this->cierreRepo->update($fakeCierre, $cierre->id);
        $this->assertModelData($fakeCierre, $updatedCierre->toArray());
        $dbCierre = $this->cierreRepo->find($cierre->id);
        $this->assertModelData($fakeCierre, $dbCierre->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCierre()
    {
        $cierre = $this->makeCierre();
        $resp = $this->cierreRepo->delete($cierre->id);
        $this->assertTrue($resp);
        $this->assertNull(Cierre::find($cierre->id), 'Cierre should not exist in DB');
    }
}
