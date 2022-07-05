<?php

use Faker\Factory as Faker;
use App\Models\Movimiento;
use App\Repositories\MovimientoRepository;

trait MakeMovimientoTrait
{
    /**
     * Create fake instance of Movimiento and save it in database
     *
     * @param array $movimientoFields
     * @return Movimiento
     */
    public function makeMovimiento($movimientoFields = [])
    {
        /** @var MovimientoRepository $movimientoRepo */
        $movimientoRepo = App::make(MovimientoRepository::class);
        $theme = $this->fakeMovimientoData($movimientoFields);
        return $movimientoRepo->create($theme);
    }

    /**
     * Get fake instance of Movimiento
     *
     * @param array $movimientoFields
     * @return Movimiento
     */
    public function fakeMovimiento($movimientoFields = [])
    {
        return new Movimiento($this->fakeMovimientoData($movimientoFields));
    }

    /**
     * Get fake data of Movimiento
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMovimientoData($movimientoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'precio' => $fake->word,
            'concepto' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $movimientoFields);
    }
}
