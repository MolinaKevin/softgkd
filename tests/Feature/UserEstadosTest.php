<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\Plan;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

class UserEstadosTest extends TestCase
{
    use DatabaseTransactions;
	//use RefreshDatabase;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userRepo = App::make(UserRepository::class);
    }

    /**
     * @test create
     */
	public function it_registers_a_user()
	{
		// Arrange: Preparar el usuario que queremos crear
		$userData = [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'password' => 'secret',
			'password_confirmation' => 'secret',
			'dni' => 11111111,
			'sexo' => 'masculino',
			'fecha_nacimiento' => '2000-01-01',
			'descuento' => 0
			// Agrega aquí cualquier otro campo que necesites
		];

		// Act: Enviar la solicitud de registro
		try {
			//$response = $this->json('POST', route('api.users.store'), $userData);
		
			$response = $this->json('POST', route('users.store'), $userData);
		} catch (\Exception $e) {
			dd($e);
		}
		
		//dd($response->getContent());

		//$response->assertSessionHasErrors();


		// Assert: Verificar que el usuario fue creado correctamente
		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Inactivo'
		]);
		// Comprobar que el status de respuesta sea correcto (redirección, en este caso)
		$response->assertStatus(302); // O el código que esperes recibir
		// Comprobar que se redirige a la página correcta
		$response->assertRedirect(route('users.index')); // O la ruta a la que esperas redirigir
	}

	/**
     * @test create
     */
	public function it_asociate_a_plan_to_a_user()
	{
		// Arrange: Preparar el usuario que queremos crear
		$userData = [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'password' => 'secret',
			'password_confirmation' => 'secret',
			'dni' => 11111111,
			'sexo' => 'masculino',
			'fecha_nacimiento' => '2000-01-01',
			'descuento' => 0
			// Agrega aquí cualquier otro campo que necesites
		];
		$plan = Plan::first();

		$response = $this->json('POST', route('users.store'), $userData);
		
		$user = User::where('first_name', 'Test')->first();
		// Act: Enviar la solicitud de registro
		try {
			//$response = $this->json('POST', route('api.users.store'), $userData);
			$response = $this->put('/api/users/' . $user->id, [
				'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
			]);
		} catch (\Exception $e) {
			dd($e);
		}
		

		// Assert: Verificar que el usuario fue creado correctamente
		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Inactivo'
		]);

		\Artisan::call('update:estados');
		
		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Inactivo'
		]);
	
		// Comprobar que el status de respuesta sea correcto (redirección, en este caso)
		$response->assertStatus(200); // O el código que esperes recibir
	} 
}
