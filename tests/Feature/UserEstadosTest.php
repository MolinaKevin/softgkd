<?php

use Tests\TestCase;
use App\Models\{
	User,
	Plan,
	Role,
	Asistencia
};
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

	public function testDatabase()
	{
		$databaseName = config('database.connections.mysql.database');
		if($databaseName == "gkd") {
			dd("Base de datos de produccion, reparar");
		}
		// Resto de tu prueba...
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

		//dd($response->getContent());
		
		$user = User::where('first_name', 'Test')->first();

		try {
			$responsep = $this->json('GET', 'api/plans/' . $plan->id . '/vencimiento');
			$res = $responsep->json();
			$vec = $res['data'];


			$response = $this->put('/api/users/' . $user->id, [
				'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
				'date' => $vec
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

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			'vencimiento' => $vec . "  23:59:59"
		]);

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
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

	/**
     * @test create
     */
	public function it_exist_a_user_after_habilitar_usuario()
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
		$response = $this->json('POST', route('users.store'), $userData);
		
		$user = User::where('first_name', 'Test')->first();

		try {
			$responsep = $this->json('GET', 'users/' . $user->id . '/agregar');
		} catch (\Exception $e) {
			dd($e);
		}
		
		$role = Role::where('slug', 'agregando')->first();

		$this->assertDatabaseHas('role_user', [
			'user_id' => $user->id,
			'role_id' => $role->id,
		]);
	
		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Inactivo'
		]);

		$asistencia = new Asistencia();

		// Puedes configurar las propiedades de la asistencia aquí.
		// Por ejemplo, si tu asistencia tiene una propiedad de fecha, podrías hacer algo como:
		$asistencia->horario = now();

		// Luego, agrega la asistencia al usuario.
		$user->asistencias()->save($asistencia);

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');
		
		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Deuda'
		]);
	
		// Comprobar que el status de respuesta sea correcto (redirección, en este caso)
		$response->assertStatus(200); // O el código que esperes recibir
	} 
}
