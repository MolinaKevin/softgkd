<?php

use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;

class TestingTest extends TestCase
{
	public function testEnvironmentFile()
	{
		$this->assertEquals('your_expected_environment', env('APP_ENV'));
	}
	 
}
