<?php

use App\Models\Deuda;
use App\Repositories\DeudaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeudaRepositoryTest extends TestCase
{
    use MakeDeudaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DeudaRepository
     */
    protected $deudaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->deudaRepo = App::make(DeudaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDeuda()
    {
        $deuda = $this->fakeDeudaData();
        $createdDeuda = $this->deudaRepo->create($deuda);
        $createdDeuda = $createdDeuda->toArray();
        $this->assertArrayHasKey('id', $createdDeuda);
        $this->assertNotNull($createdDeuda['id'], 'Created Deuda must have id specified');
        $this->assertNotNull(Deuda::find($createdDeuda['id']), 'Deuda with given id must be in DB');
        $this->assertModelData($deuda, $createdDeuda);
    }

    /**
     * @test read
     */
    public function testReadDeuda()
    {
        $deuda = $this->makeDeuda();
        $dbDeuda = $this->deudaRepo->find($deuda->id);
        $dbDeuda = $dbDeuda->toArray();
        $this->assertModelData($deuda->toArray(), $dbDeuda);
    }

    /**
     * @test update
     */
    public function testUpdateDeuda()
    {
        $deuda = $this->makeDeuda();
        $fakeDeuda = $this->fakeDeudaData();
        $updatedDeuda = $this->deudaRepo->update($fakeDeuda, $deuda->id);
        $this->assertModelData($fakeDeuda, $updatedDeuda->toArray());
        $dbDeuda = $this->deudaRepo->find($deuda->id);
        $this->assertModelData($fakeDeuda, $dbDeuda->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDeuda()
    {
        $deuda = $this->makeDeuda();
        $resp = $this->deudaRepo->delete($deuda->id);
        $this->assertTrue($resp);
        $this->assertNull(Deuda::find($deuda->id), 'Deuda should not exist in DB');
    }
}
