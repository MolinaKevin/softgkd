<?php

use App\Models\{
    Deuda, User
};
use Illuminate\Database\Seeder;

class PagoDeudaGimnasioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $deudas = $user->deudas;
            if ($user->hasFamilia()) {
                $pagable = $user->familia;
            } else {
                $pagable = $user;
            }
            foreach ($deudas as $deudaAux) {
                $deuda = Deuda::find($deudaAux->id);
                $pagable->addPago('Deuda: '.$deuda->concepto, $deuda->precio);
                $deuda->deudable->renovar();
                $deuda->deudable->desadeudar();
                $deuda->delete();
            }

        }
    }
}
