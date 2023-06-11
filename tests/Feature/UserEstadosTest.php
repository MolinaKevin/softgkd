<?php

use Tests\TestCase;
use App\Models\{
	User,
	Plan,
	Role,
	Huella,
	Caja,
	Deuda,
	Asistencia
};
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
 
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
		$this->assertTrue(true);	
	}


    /**
     * @test create
     */
	public function it_registers_a_user_makes_it_inactive()
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
	public function it_asociate_a_plan_to_a_user_makes_it_inactive()
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
	public function it_doesnt_exist_a_metodo_acceso()
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
			'estado' => 'Metodo de Acceso'
		]);
	
		// Comprobar que el status de respuesta sea correcto (redirección, en este caso)
		$response->assertStatus(302); // O el código que esperes recibir
	} 
	
	/**
     * @test create
     */
	public function it_asociates_a_deuda_if_user_join()
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

		$plan = Plan::first();

		try {
			$response = $this->json('GET', 'users/' . $user->id . '/agregar');

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
		$user->huellas()->save(new Huella());

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
			'estado' => 'Deuda'
		]);
	
		// Comprobar que el status de respuesta sea correcto (redirección, en este caso)
		$response->assertStatus(200); // O el código que esperes recibir
	} 

	/**
     * @test create
     */
	public function it_makes_user_inactive_if_user_doesnt_join()
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

		$plan = Plan::first();

		try {
			$response = $this->json('GET', 'users/' . $user->id . '/agregar');

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


		// Puedes configurar las propiedades de la asistencia aquí.
		// Por ejemplo, si tu asistencia tiene una propiedad de fecha, podrías hacer algo como:

		// Luego, agrega la asistencia al usuario.
		$user->huellas()->save(new Huella());

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
	public function it_pays_and_get_pagado_status()
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

		$plan = Plan::first();

		$response = $this->json('GET', 'users/' . $user->id . '/agregar');

		$responsep = $this->json('GET', 'api/plans/' . $plan->id . '/vencimiento');
		$res = $responsep->json();
		$vec = $res['data'];


		$response = $this->put('/api/users/' . $user->id, [
			'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
			'date' => $vec
		]);

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
			//'vencimiento' => $vec . "  23:59:59"
			// @TODO Revisar vencimiento
		]);

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');
		

		$caja = Caja::first();

		$response = $this->json('GET', 'api/users/' . $user->id . '/renovar/' . $plan->id, [
			'metodoPago' => 1,
			'caja' => $caja->id,
			'monto' => $plan->precio,
			'periodo' => date('m'),
			'descontar' => 0 
		]);
		//dd($response->getContent());

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 1,
			//'vencimiento' => $vec . "  23:59:59"
			// @TODO Revisar vencimiento
		]);
	
		// Comprobar que el status de respuesta sea correcto (redirección, en este caso)
		$response->assertStatus(200); // O el código que esperes recibir
	}

	/**
     * @test create
     */
	public function it_pays_and_doesnt_join_makes_it_inactive()
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

		$plan = Plan::first();

		$response = $this->json('GET', 'users/' . $user->id . '/agregar');

		$responsep = $this->json('GET', 'api/plans/' . $plan->id . '/vencimiento');
		$res = $responsep->json();
		$vec = $res['data'];


		$response = $this->put('/api/users/' . $user->id, [
			'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
			'date' => $vec
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Inactivo'
		]);

		$user->huellas()->save(new Huella());

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			'vencimiento' => $vec . "  23:59:59"
		]);

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');
		

		$caja = Caja::first();

		$response = $this->json('GET', 'api/users/' . $user->id . '/renovar/' . $plan->id, [
			'metodoPago' => 1,
			'caja' => $caja->id,
			'monto' => $plan->precio,
			'periodo' => date('m'),
			'descontar' => 0 
		]);
		//dd($response->getContent());

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 1,
			//'vencimiento' => $vec . "  23:59:59"
			// @TODO Revisar vencimiento
		]);

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
	public function it_pays_get_in_and_makes_it_correcto()
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

		$plan = Plan::first();

		$response = $this->json('GET', 'users/' . $user->id . '/agregar');

		$responsep = $this->json('GET', 'api/plans/' . $plan->id . '/vencimiento');
		$res = $responsep->json();
		$vec = $res['data'];


		$response = $this->put('/api/users/' . $user->id, [
			'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
			'date' => $vec
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Inactivo'
		]);

		$user->huellas()->save(new Huella());
		$user->asistencias()->save(new Asistencia());

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			'vencimiento' => $vec . "  23:59:59"
		]);

		//\Artisan::call('update:estados');
		//\Artisan::call('update:planes');
		//\Artisan::call('update:estados');
		

		$caja = Caja::first();

		$response = $this->json('GET', 'api/users/' . $user->id . '/renovar/' . $plan->id, [
			'metodoPago' => 1,
			'caja' => $caja->id,
			'monto' => $plan->precio,
			'periodo' => date('m'),
			'descontar' => 0 
		]);
		//dd($response->getContent());

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 1,
			//'vencimiento' => $vec . "  23:59:59"
			// @TODO Revisar vencimiento
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Correcto'
		]);
	
		// Comprobar que el status de respuesta sea correcto (redirección, en este caso)
		$response->assertStatus(200); // O el código que esperes recibir
	}

	/**
     * @test create
     */
	public function it_is_correcto_plan_is_vencido_it_doesnt_pays_and_gets_inactivo()
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
			'descuento' => 0,
			'estado' => "Correcto"
			// Agrega aquí cualquier otro campo que necesites
		];
		$response = $this->json('POST', route('users.store'), $userData);
		
		$user = User::where('first_name', 'Test')->first();

		$plan = Plan::first();

		$response = $this->json('GET', 'users/' . $user->id . '/agregar');

		$vec = Carbon::now()->subDay()->format('Y-m-d');

		$response = $this->put('/api/users/' . $user->id, [
			'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
			'date' => $vec
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Correcto'
		]);

		$user->huellas()->save(new Huella());

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			'vencimiento' => $vec . "  23:59:59"
		]);

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			//'vencimiento' => $vec . "  23:59:59"
			// @TODO Revisar vencimiento
		]);

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
	public function it_is_correcto_plan_is_vencido_it_pays_and_gets_inactivo()
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
			'descuento' => 0,
			'estado' => "Correcto"
			// Agrega aquí cualquier otro campo que necesites
		];
		$response = $this->json('POST', route('users.store'), $userData);
		
		$user = User::where('first_name', 'Test')->first();

		$plan = Plan::first();

		$response = $this->json('GET', 'users/' . $user->id . '/agregar');

		$vec = Carbon::now()->subDay()->format('Y-m-d');

		$response = $this->put('/api/users/' . $user->id, [
			'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
			'date' => $vec
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Correcto'
		]);

		$user->huellas()->save(new Huella());

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			'vencimiento' => $vec . "  23:59:59"
		]);

		$caja = Caja::first();

		$response = $this->json('GET', 'api/users/' . $user->id . '/renovar/' . $plan->id, [
			'metodoPago' => 1,
			'caja' => $caja->id,
			'monto' => $plan->precio,
			'periodo' => date('m'),
			'descontar' => 0 
		]);

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 1,
			//'vencimiento' => $vec . "  23:59:59"
			// @TODO Revisar vencimiento
		]);

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
	public function it_is_correcto_plan_is_vencido_it_pays_get_a_asistencia_and_gets_correcto()
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
			'descuento' => 0,
			'estado' => "Correcto"
			// Agrega aquí cualquier otro campo que necesites
		];
		$response = $this->json('POST', route('users.store'), $userData);
		
		$user = User::where('first_name', 'Test')->first();

		$plan = Plan::first();

		$response = $this->json('GET', 'users/' . $user->id . '/agregar');

		$vec = Carbon::now()->subDay()->format('Y-m-d');

		$response = $this->put('/api/users/' . $user->id, [
			'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
			'date' => $vec
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Correcto'
		]);

		$user->huellas()->save(new Huella());
		$user->asistencias()->save(new Asistencia());

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			'vencimiento' => $vec . "  23:59:59"
		]);

		$caja = Caja::first();

		$response = $this->json('GET', 'api/users/' . $user->id . '/renovar/' . $plan->id, [
			'metodoPago' => 1,
			'caja' => $caja->id,
			'monto' => $plan->precio,
			'periodo' => date('m'),
			'descontar' => 0 
		]);

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 1,
			//'vencimiento' => $vec . "  23:59:59"
			// @TODO Revisar vencimiento
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Correcto'
		]);
	
		// Comprobar que el status de respuesta sea correcto (redirección, en este caso)
		$response->assertStatus(200); // O el código que esperes recibir
	}

	/**
     * @test create
     */
	public function it_is_deuda_and_pago_parcial_gets_deuda()
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
			'descuento' => 0,
			'estado' => "Deuda"
			// Agrega aquí cualquier otro campo que necesites
		];
		$response = $this->json('POST', route('users.store'), $userData);
		
		$user = User::where('first_name', 'Test')->first();

		$plan = Plan::first();

		$response = $this->json('GET', 'users/' . $user->id . '/agregar');

		$vec = Carbon::now()->subDay()->format('Y-m-d');

		$response = $this->put('/api/users/' . $user->id, [
			'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
			'date' => $vec
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Deuda'
		]);

		$user->huellas()->save(new Huella());

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			'vencimiento' => $vec . "  23:59:59"
		]);
	
		$deudaData = [
			'precio' => $plan->precio,
			'concepto' => "Deuda Test",
			'deudable_id' => $plan->id,
			'deudable_type' => "App\Models\PlanUser",
			'adeudable_id' => $user->id,
			'adeudable_type' => "App\Models\User",
		];

		
		$response = $this->json('POST', route('deudas.store'), $deudaData);

		$this->assertDatabaseHas('deudas', [
			'adeudable_id' => $user->id,
			'deudable_id' => $plan->id,
			'precio' => $plan->precio,
			'concepto' => "Deuda Test",
		]);
		//dd($user->deudas()->first());

		$caja = Caja::first();

		$response = $this->json('POST', 'api/users/' . $user->id . '/pagoParcial', [
			'metodo' => 1,
			'caja' => $caja->id,
			'pago' => $plan->precio / 2,
		]);

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');

		$this->assertDatabaseHas('pagos', [
			'precio' => $plan->precio / 2,
            'concepto' => "Pago parcial por " . $user->name,
			'pagable_type' => 'App\Models\User',
			'pagable_id' => $user->id,
		]);


		$this->assertDatabaseHas('deudas', [
			'adeudable_id' => $user->id,
			'deudable_id' => $plan->id,
			'precio' => $plan->precio - $plan->precio / 2,
			'concepto' => "Deuda Test",
		]);

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			//'vencimiento' => $vec . "  23:59:59"
			// @TODO Revisar vencimiento
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Deuda'
		]);
	
		// Comprobar que el status de respuesta sea correcto (redirección, en este caso)
		$response->assertStatus(200); // O el código que esperes recibir
	}

	/**
     * @test create
     */
	public function it_is_deuda_and_pago_doesnt_go_in_gets_inactivo()
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
			'descuento' => 0,
			'estado' => "Deuda"
			// Agrega aquí cualquier otro campo que necesites
		];
		$response = $this->json('POST', route('users.store'), $userData);
		
		$user = User::where('first_name', 'Test')->first();

		$plan = Plan::first();

		$response = $this->json('GET', 'users/' . $user->id . '/agregar');

		$vec = Carbon::now()->subDay()->format('Y-m-d');

		$response = $this->put('/api/users/' . $user->id, [
			'plans' => [$plan->id], // Reemplazar $planId con el ID del plan que deseas asociar
			'date' => $vec
		]);

		$this->assertDatabaseHas('users', [
			'first_name' => 'Test',
			'last_name' => 'User',
			'email' => 'test@example.com',
			'estado' => 'Deuda'
		]);

		$user->huellas()->save(new Huella());

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 0,
			'vencimiento' => $vec . "  23:59:59"
		]);
	
		$deudaData = [
			'precio' => $plan->precio,
			'concepto' => "Deuda Test"
			'deudable_id' => $user->plans()->where('plan_id', $plan->id)->first()->pivot->id,
			'deudable_type' => "App\Models\PlanUser",
			'adeudable_id' => $user->id,
			'adeudable_type' => "App\Models\User",
		];
		
		$response = $this->json('POST', route('deudas.store'), $deudaData);

		$this->assertDatabaseHas('deudas', [
			'adeudable_id' => $user->id,
			'deudable_id' => $plan->id,
			'precio' => $plan->precio,
			'concepto' => "Deuda Test",
		]);
		//dd($user->deudas()->first());

		$caja = Caja::first();

		$response = $this->json('GET', 'api/users/' . $user->id . '/pagarDeuda/' . $user->deudas()->first()->id, [
			'metodoPago' => 1,
			'caja' => $caja->id,
			'descontar' => 0
		]);

		\Artisan::call('update:estados');
		\Artisan::call('update:planes');
		\Artisan::call('update:estados');

		$this->assertDatabaseHas('pagos', [
			'precio' => $plan->precio,
			'pagable_type' => 'App\Models\User',
			'pagable_id' => $user->id,
		]);

		$this->assertDatabaseHas('deudas', [
			'adeudable_id' => $user->id,
			'deudable_id' => $plan->id,
			'precio' => $plan->precio,
			'concepto' => "Deuda Test",
		]);
		
		$deuda = Deuda::withTrashed()->where('concepto', 'Deuda Test')->first();
		$this->assertNotNull($deuda->deleted_at);

		$this->assertDatabaseHas('plan_user', [
			'user_id' => $user->id,
			'plan_id' => $plan->id,
			'pagado' => 1,
			//'vencimiento' => $vec . "  23:59:59"
			// @TODO Revisar vencimiento
		]);

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
