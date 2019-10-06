<?php

use App\Models\Conexion;
use App\Repositories\ConexionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConexionRepositoryTest extends TestCase
{
    use MakeConexionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ConexionRepository
     */
    protected $conexionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->conexionRepo = App::make(ConexionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateConexion()
    {
        $conexion = $this->fakeConexionData();
        $createdConexion = $this->conexionRepo->create($conexion);
        $createdConexion = $createdConexion->toArray();
        $this->assertArrayHasKey('id', $createdConexion);
        $this->assertNotNull($createdConexion['id'], 'Created Conexion must have id specified');
        $this->assertNotNull(Conexion::find($createdConexion['id']), 'Conexion with given id must be in DB');
        $this->assertModelData($conexion, $createdConexion);
    }

    /**
     * @test read
     */
    public function testReadConexion()
    {
        $conexion = $this->makeConexion();
        $dbConexion = $this->conexionRepo->find($conexion->id);
        $dbConexion = $dbConexion->toArray();
        $this->assertModelData($conexion->toArray(), $dbConexion);
    }

    /**
     * @test update
     */
    public function testUpdateConexion()
    {
        $conexion = $this->makeConexion();
        $fakeConexion = $this->fakeConexionData();
        $updatedConexion = $this->conexionRepo->update($fakeConexion, $conexion->id);
        $this->assertModelData($fakeConexion, $updatedConexion->toArray());
        $dbConexion = $this->conexionRepo->find($conexion->id);
        $this->assertModelData($fakeConexion, $dbConexion->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteConexion()
    {
        $conexion = $this->makeConexion();
        $resp = $this->conexionRepo->delete($conexion->id);
        $this->assertTrue($resp);
        $this->assertNull(Conexion::find($conexion->id), 'Conexion should not exist in DB');
    }
}
