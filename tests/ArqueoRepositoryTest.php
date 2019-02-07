<?php

use App\Models\Arqueo;
use App\Repositories\ArqueoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArqueoRepositoryTest extends TestCase
{
    use MakeArqueoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ArqueoRepository
     */
    protected $arqueoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->arqueoRepo = App::make(ArqueoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateArqueo()
    {
        $arqueo = $this->fakeArqueoData();
        $createdArqueo = $this->arqueoRepo->create($arqueo);
        $createdArqueo = $createdArqueo->toArray();
        $this->assertArrayHasKey('id', $createdArqueo);
        $this->assertNotNull($createdArqueo['id'], 'Created Arqueo must have id specified');
        $this->assertNotNull(Arqueo::find($createdArqueo['id']), 'Arqueo with given id must be in DB');
        $this->assertModelData($arqueo, $createdArqueo);
    }

    /**
     * @test read
     */
    public function testReadArqueo()
    {
        $arqueo = $this->makeArqueo();
        $dbArqueo = $this->arqueoRepo->find($arqueo->id);
        $dbArqueo = $dbArqueo->toArray();
        $this->assertModelData($arqueo->toArray(), $dbArqueo);
    }

    /**
     * @test update
     */
    public function testUpdateArqueo()
    {
        $arqueo = $this->makeArqueo();
        $fakeArqueo = $this->fakeArqueoData();
        $updatedArqueo = $this->arqueoRepo->update($fakeArqueo, $arqueo->id);
        $this->assertModelData($fakeArqueo, $updatedArqueo->toArray());
        $dbArqueo = $this->arqueoRepo->find($arqueo->id);
        $this->assertModelData($fakeArqueo, $dbArqueo->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteArqueo()
    {
        $arqueo = $this->makeArqueo();
        $resp = $this->arqueoRepo->delete($arqueo->id);
        $this->assertTrue($resp);
        $this->assertNull(Arqueo::find($arqueo->id), 'Arqueo should not exist in DB');
    }
}
