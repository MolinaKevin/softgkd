<?php

use Faker\Factory as Faker;
use App\Models\Familia;
use App\Repositories\FamiliaRepository;

trait MakeFamiliaTrait
{
    /**
     * Create fake instance of Familia and save it in database
     *
     * @param array $familiaFields
     * @return Familia
     */
    public function makeFamilia($familiaFields = [])
    {
        /** @var FamiliaRepository $familiaRepo */
        $familiaRepo = App::make(FamiliaRepository::class);
        $theme = $this->fakeFamiliaData($familiaFields);
        return $familiaRepo->create($theme);
    }

    /**
     * Get fake instance of Familia
     *
     * @param array $familiaFields
     * @return Familia
     */
    public function fakeFamilia($familiaFields = [])
    {
        return new Familia($this->fakeFamiliaData($familiaFields));
    }

    /**
     * Get fake data of Familia
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFamiliaData($familiaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $familiaFields);
    }
}
