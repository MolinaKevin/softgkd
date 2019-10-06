<?php

use Faker\Factory as Faker;
use App\Models\Conexion;
use App\Repositories\ConexionRepository;

trait MakeConexionTrait
{
    /**
     * Create fake instance of Conexion and save it in database
     *
     * @param array $conexionFields
     * @return Conexion
     */
    public function makeConexion($conexionFields = [])
    {
        /** @var ConexionRepository $conexionRepo */
        $conexionRepo = App::make(ConexionRepository::class);
        $theme = $this->fakeConexionData($conexionFields);
        return $conexionRepo->create($theme);
    }

    /**
     * Get fake instance of Conexion
     *
     * @param array $conexionFields
     * @return Conexion
     */
    public function fakeConexion($conexionFields = [])
    {
        return new Conexion($this->fakeConexionData($conexionFields));
    }

    /**
     * Get fake data of Conexion
     *
     * @param array $postFields
     * @return array
     */
    public function fakeConexionData($conexionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'concepto' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $conexionFields);
    }
}
