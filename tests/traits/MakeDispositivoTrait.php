<?php

use Faker\Factory as Faker;
use App\Models\Dispositivo;
use App\Repositories\DispositivoRepository;

trait MakeDispositivoTrait
{
    /**
     * Create fake instance of Dispositivo and save it in database
     *
     * @param array $dispositivoFields
     * @return Dispositivo
     */
    public function makeDispositivo($dispositivoFields = [])
    {
        /** @var DispositivoRepository $dispositivoRepo */
        $dispositivoRepo = App::make(DispositivoRepository::class);
        $theme = $this->fakeDispositivoData($dispositivoFields);
        return $dispositivoRepo->create($theme);
    }

    /**
     * Get fake instance of Dispositivo
     *
     * @param array $dispositivoFields
     * @return Dispositivo
     */
    public function fakeDispositivo($dispositivoFields = [])
    {
        return new Dispositivo($this->fakeDispositivoData($dispositivoFields));
    }

    /**
     * Get fake data of Dispositivo
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDispositivoData($dispositivoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'ip' => $fake->word,
            'puerto' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $dispositivoFields);
    }
}
