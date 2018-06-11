<?php

use Faker\Factory as Faker;
use App\Models\Asistencia;
use App\Repositories\AsistenciaRepository;

trait MakeAsistenciaTrait
{
    /**
     * Create fake instance of Asistencia and save it in database
     *
     * @param array $asistenciaFields
     * @return Asistencia
     */
    public function makeAsistencia($asistenciaFields = [])
    {
        /** @var AsistenciaRepository $asistenciaRepo */
        $asistenciaRepo = App::make(AsistenciaRepository::class);
        $theme = $this->fakeAsistenciaData($asistenciaFields);
        return $asistenciaRepo->create($theme);
    }

    /**
     * Get fake instance of Asistencia
     *
     * @param array $asistenciaFields
     * @return Asistencia
     */
    public function fakeAsistencia($asistenciaFields = [])
    {
        return new Asistencia($this->fakeAsistenciaData($asistenciaFields));
    }

    /**
     * Get fake data of Asistencia
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAsistenciaData($asistenciaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'horario' => $fake->date('Y-m-d H:i:s'),
            'user_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'actividad' => $fake->word
        ], $asistenciaFields);
    }
}
