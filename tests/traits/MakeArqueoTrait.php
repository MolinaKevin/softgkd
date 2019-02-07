<?php

use Faker\Factory as Faker;
use App\Models\Arqueo;
use App\Repositories\ArqueoRepository;

trait MakeArqueoTrait
{
    /**
     * Create fake instance of Arqueo and save it in database
     *
     * @param array $arqueoFields
     * @return Arqueo
     */
    public function makeArqueo($arqueoFields = [])
    {
        /** @var ArqueoRepository $arqueoRepo */
        $arqueoRepo = App::make(ArqueoRepository::class);
        $theme = $this->fakeArqueoData($arqueoFields);
        return $arqueoRepo->create($theme);
    }

    /**
     * Get fake instance of Arqueo
     *
     * @param array $arqueoFields
     * @return Arqueo
     */
    public function fakeArqueo($arqueoFields = [])
    {
        return new Arqueo($this->fakeArqueoData($arqueoFields));
    }

    /**
     * Get fake data of Arqueo
     *
     * @param array $postFields
     * @return array
     */
    public function fakeArqueoData($arqueoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'total' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $arqueoFields);
    }
}
