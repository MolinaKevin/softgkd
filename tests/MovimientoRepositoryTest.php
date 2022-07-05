<?php

use App\Models\Movimiento;
use App\Repositories\MovimientoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MovimientoRepositoryTest extends TestCase
{
    use MakeMovimientoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MovimientoRepository
     */
    protected $movimientoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->movimientoRepo = App::make(MovimientoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMovimiento()
    {
        $movimiento = $this->fakeMovimientoData();
        $createdMovimiento = $this->movimientoRepo->create($movimiento);
        $createdMovimiento = $createdMovimiento->toArray();
        $this->assertArrayHasKey('id', $createdMovimiento);
        $this->assertNotNull($createdMovimiento['id'], 'Created Movimiento must have id specified');
        $this->assertNotNull(Movimiento::find($createdMovimiento['id']), 'Movimiento with given id must be in DB');
        $this->assertModelData($movimiento, $createdMovimiento);
    }

    /**
     * @test read
     */
    public function testReadMovimiento()
    {
        $movimiento = $this->makeMovimiento();
        $dbMovimiento = $this->movimientoRepo->find($movimiento->id);
        $dbMovimiento = $dbMovimiento->toArray();
        $this->assertModelData($movimiento->toArray(), $dbMovimiento);
    }

    /**
     * @test update
     */
    public function testUpdateMovimiento()
    {
        $movimiento = $this->makeMovimiento();
        $fakeMovimiento = $this->fakeMovimientoData();
        $updatedMovimiento = $this->movimientoRepo->update($fakeMovimiento, $movimiento->id);
        $this->assertModelData($fakeMovimiento, $updatedMovimiento->toArray());
        $dbMovimiento = $this->movimientoRepo->find($movimiento->id);
        $this->assertModelData($fakeMovimiento, $dbMovimiento->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMovimiento()
    {
        $movimiento = $this->makeMovimiento();
        $resp = $this->movimientoRepo->delete($movimiento->id);
        $this->assertTrue($resp);
        $this->assertNull(Movimiento::find($movimiento->id), 'Movimiento should not exist in DB');
    }
}
