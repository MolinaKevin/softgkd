<?php

use App\Models\Cierres;
use App\Repositories\CierresRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CierresRepositoryTest extends TestCase
{
    use MakeCierresTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CierresRepository
     */
    protected $cierresRepo;

    public function setUp()
    {
        parent::setUp();
        $this->cierresRepo = App::make(CierresRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCierres()
    {
        $cierres = $this->fakeCierresData();
        $createdCierres = $this->cierresRepo->create($cierres);
        $createdCierres = $createdCierres->toArray();
        $this->assertArrayHasKey('id', $createdCierres);
        $this->assertNotNull($createdCierres['id'], 'Created Cierres must have id specified');
        $this->assertNotNull(Cierres::find($createdCierres['id']), 'Cierres with given id must be in DB');
        $this->assertModelData($cierres, $createdCierres);
    }

    /**
     * @test read
     */
    public function testReadCierres()
    {
        $cierres = $this->makeCierres();
        $dbCierres = $this->cierresRepo->find($cierres->id);
        $dbCierres = $dbCierres->toArray();
        $this->assertModelData($cierres->toArray(), $dbCierres);
    }

    /**
     * @test update
     */
    public function testUpdateCierres()
    {
        $cierres = $this->makeCierres();
        $fakeCierres = $this->fakeCierresData();
        $updatedCierres = $this->cierresRepo->update($fakeCierres, $cierres->id);
        $this->assertModelData($fakeCierres, $updatedCierres->toArray());
        $dbCierres = $this->cierresRepo->find($cierres->id);
        $this->assertModelData($fakeCierres, $dbCierres->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCierres()
    {
        $cierres = $this->makeCierres();
        $resp = $this->cierresRepo->delete($cierres->id);
        $this->assertTrue($resp);
        $this->assertNull(Cierres::find($cierres->id), 'Cierres should not exist in DB');
    }
}
