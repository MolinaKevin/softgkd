<?php

use App\Models\Familia;
use App\Repositories\FamiliaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FamiliaRepositoryTest extends TestCase
{
    use MakeFamiliaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FamiliaRepository
     */
    protected $familiaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->familiaRepo = App::make(FamiliaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFamilia()
    {
        $familia = $this->fakeFamiliaData();
        $createdFamilia = $this->familiaRepo->create($familia);
        $createdFamilia = $createdFamilia->toArray();
        $this->assertArrayHasKey('id', $createdFamilia);
        $this->assertNotNull($createdFamilia['id'], 'Created Familia must have id specified');
        $this->assertNotNull(Familia::find($createdFamilia['id']), 'Familia with given id must be in DB');
        $this->assertModelData($familia, $createdFamilia);
    }

    /**
     * @test read
     */
    public function testReadFamilia()
    {
        $familia = $this->makeFamilia();
        $dbFamilia = $this->familiaRepo->find($familia->id);
        $dbFamilia = $dbFamilia->toArray();
        $this->assertModelData($familia->toArray(), $dbFamilia);
    }

    /**
     * @test update
     */
    public function testUpdateFamilia()
    {
        $familia = $this->makeFamilia();
        $fakeFamilia = $this->fakeFamiliaData();
        $updatedFamilia = $this->familiaRepo->update($fakeFamilia, $familia->id);
        $this->assertModelData($fakeFamilia, $updatedFamilia->toArray());
        $dbFamilia = $this->familiaRepo->find($familia->id);
        $this->assertModelData($fakeFamilia, $dbFamilia->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFamilia()
    {
        $familia = $this->makeFamilia();
        $resp = $this->familiaRepo->delete($familia->id);
        $this->assertTrue($resp);
        $this->assertNull(Familia::find($familia->id), 'Familia should not exist in DB');
    }
}
