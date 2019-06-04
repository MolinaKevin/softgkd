<?php

use Faker\Factory as Faker;
use App\Models\Plan;
use App\Repositories\PlanRepository;

trait MakePlanTrait
{
    /**
     * Create fake instance of Plan and save it in database
     *
     * @param array $planFields
     * @return Plan
     */
    public function makePlan($planFields = [])
    {
        /** @var PlanRepository $planRepo */
        $planRepo = App::make(PlanRepository::class);
        $theme = $this->fakePlanData($planFields);
        return $planRepo->create($theme);
    }

    /**
     * Get fake instance of Plan
     *
     * @param array $planFields
     * @return Plan
     */
    public function fakePlan($planFields = [])
    {
        return new Plan($this->fakePlanData($planFields));
    }

    /**
     * Get fake data of Plan
     *
     * @param array $postFields
     * @return array
     */
    public function fakePlanData($planFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'precio' => $fake->randomDigitNotNull,
            'cantidad' => $fake->randomDigitNotNull,
            'date' => $fake->word,
            'porDia' => $fake->randomDigitNotNull,
            'limite' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $planFields);
    }
}
