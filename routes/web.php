<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\AccountSettingProfile;
use App\Http\Livewire\AccountSettingYape;
//use App\Http\Livewire\SisCrudEmpresa;
use App\Http\Livewire\DashboardGeneral;
use App\Http\Livewire\PageBolsaLaboral;
use App\Http\Livewire\PagePostulacion;
use App\Http\Livewire\PagePostulante;
use App\Http\Livewire\PageResulPostulacion;
use App\Http\Livewire\SecurityPermissions;
use App\Http\Livewire\SecurityRoles;
use App\Http\Livewire\SisCrudAplication;
use App\Http\Livewire\SisCrudEmpresa;
use App\Http\Livewire\SisCrudOfertaLaboral;
use App\Http\Livewire\SisCrudPostulante;
use App\Http\Livewire\SisValidacionAplication;
use App\Http\Livewire\TableCategories;
use App\Http\Livewire\TableProducts;
use App\Http\Livewire\TableUsers;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yoeunes\Toastr\Facades\Toastr as FacadesToastr;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/login-google', function () {
//     return Socialite::driver('google')->redirect();
// });
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('login-google');

Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    //dd($user);
    $userArray = $user->user;

    // Accede a un elemento específico dentro del array
    $names = ucwords(strtolower($userArray['given_name']));
    $apellidos = $userArray['family_name'];
    $nameParts = explode(' ', $apellidos);
    $apellidoM = ucwords(strtolower(end($nameParts)));
    array_pop($nameParts);
    $apellidoP = ucwords(strtolower(end($nameParts)));

    $email = $user->email;
    $userExits = User::where('email', $email)->first();
    $viewFrom = session('from');
    $viewFromLR = session('fromLRV');
    if ($viewFrom === 'login-bolsa' || $userExits) {
        // Estás en la vista de login
        if ($userExits) {
            if ($userExits->external_auth == 'google') {
                // Verifica si el usuario ya tiene un rol asociado, si no, crea uno
                if (!$userExits->roles->count()) {
                    $role = Role::where('name', 'Postulante')->first();
                    if ($role) {
                        $userExits->roles()->attach($role);
                    } else {
                        // Si el rol no existe, maneja este caso de acuerdo a tus necesidades
                        // Puede ser lanzar una excepción, registrar un mensaje de error, etc.
                    }
                }
                Auth::login($userExits);
                FacadesToastr::success(
                    'El Postulante inició sesión exitosamente
                ',
                    'Acceso exitoso',
                );

                if ($viewFromLR === 'login-register') {
                    session()->forget('fromLR');
                    return redirect()->route('inicio');
                } else {
                    session()->forget('fromLR');
                    return redirect('/');
                }
            } else {
                $userExits->update([
                    'avatar' => $user->avatar,
                    'external_id' => $user->id,
                    'external_auth' => 'google',
                ]);

                if (!$userExits->roles->count()) {
                    $role = Role::where('name', 'Postulante')->first();
                    if ($role) {
                        $userExits->roles()->attach($role);
                    } else {
                        // Si el rol no existe, maneja este caso de acuerdo a tus necesidades
                        // Puede ser lanzar una excepción, registrar un mensaje de error, etc.
                    }
                }
                Auth::login($userExits);
                FacadesToastr::success(
                    'El Postulante inició sesión exitosamente
                ',
                    'Acceso exitoso',
                );
                $viewFromLR = session('fromLR');
                if ($viewFromLR === 'login-register') {
                    session()->forget('fromLR');
                    return redirect()->route('inicio');
                } else {
                    session()->forget('fromLR');
                    return redirect('/');
                }
            }
        } else {
            // Mostrar una notificación usando toastr
            FacadesToastr::error('No existe la cuenta en BOLSALABORAL, tiene que REGISTRARSE.');
            return redirect('/registrar-nuevo-usuario');
        }
    } elseif ($viewFrom === 'registrar-nuevo-usuario') {
        // Estás en la vista de registro
        if (!$userExits) {
            $userNew = User::create([
                'name' => $names,
                'names' => $names,
                'email' => $user->email,
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'apellido_m' => $apellidoM,
                'apellido_p' => $apellidoP,
                'avatar' => $user->avatar,
                'external_id' => $user->id,
                'external_auth' => 'google',
            ]);
            if (!$userNew->roles->count()) {
                $role = Role::where('name', 'Postulante')->first();
                if ($role) {
                    $userNew->roles()->attach($role);
                } else {
                    // Si el rol no existe, maneja este caso de acuerdo a tus necesidades
                    // Puede ser lanzar una excepción, registrar un mensaje de error, etc.
                }
            }

            Auth::login($userNew);
            FacadesToastr::success(
                'El Postulante inició sesión exitosamente
            ',
                'Acceso exitoso',
            );
            $viewFromLR = session('fromLR');
            if ($viewFromLR === 'login-register') {
                session()->forget('fromLR');
                return redirect()->route('inicio');
            } else {
                session()->forget('fromLR');
                return redirect('/');
            }
        }
    }
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        // Route::get('/', function () {
        //     return view('welcome');
        // })->name('/');


        Route::get('/', PageBolsaLaboral::class)->name('inicio');

        // RUTAS DE LOGIN/REGISTER/LOGOUT/UPDATE/DESTROY PERSONALIZADOS
        Route::controller(AuthController::class)->group(function () {
            Route::post('/logout_user', 'logout_user')->name('logout_user');
            Route::post('/register_user', 'create_user')->name('register_user');
            Route::post('/iniciar_user', 'login_user')->name('iniciar_user');
        });

        // RUTAS DE VERIFICACIÓN PERSONALIZADOS
        Route::get('/email/verify-notice', 'App\Http\Controllers\VerificationController@notice')->name('verificacion.notice');
        Route::get('/email/verify/{id}', 'App\Http\Controllers\VerificationController@verify')->name('verificacion.verify');
        Route::get('/email/resend', 'App\Http\Controllers\VerificationController@resend')->name('verificacion.resend');

        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified'
        ])->group(function () {
            Route::get('/sistema/pagina/dashboard-general', DashboardGeneral::class)->name('dashboard-general');
            Route::get('/sistema/pagina/dashboard-ventas', DashboardGeneral::class)->name('dashboard-ventas');

            Route::get('/sistema/pagina/configurar-cuenta-perfil', AccountSettingProfile::class)->name('configurar-cuenta-perfil');
            Route::get('/sistema/pagina/configurar-cuenta-yape', AccountSettingYape::class)->name('configurar-cuenta-yape');

            Route::get('/sistema/pagina/seguridad-roles', SecurityRoles::class)->name('seguridad-roles');
            Route::get('/sistema/pagina/seguridad-permisos', SecurityPermissions::class)->name('seguridad-permisos');
            Route::get('/sistema/pagina/favoritos', AccountSettingProfile::class)->name('favoritos');
            Route::get('/sistema/pagina/mensajes', AccountSettingProfile::class)->name('mensajes');

            Route::get('/sistema/pagina/tabla-usuarios', TableUsers::class)->name('tabla-usuarios');
            Route::get('/sistema/pagina/tabla-categorias', TableCategories::class)->name('tabla-categorias');
            Route::get('/sistema/pagina/tabla-productos', TableProducts::class)->name('tabla-productos');
            Route::get('/sistema/pagina/tabla-empresas', SisCrudEmpresa::class)->name('tabla-empresas');
            Route::Resource('empresa', SisCrudEmpresa::class);

            Route::get('/sistema/pagina/tabla-ofertas-laborales', SisCrudOfertaLaboral::class)->name('tabla-ofertas-laborales');
            Route::get('/sistema/pagina/oferta-laboral/show/{id}', [SisCrudOfertaLaboral::class, 'show'])->name('oferta-laboral.show');
            Route::Resource('oferta_laboral', SisCrudOfertaLaboral::class);

            Route::get('/sistema/pagina/tabla-banners', AccountSettingProfile::class)->name('tabla-banners');

            Route::get('/sistema/pagina/tabla-venta-clientes', SisCrudPostulante::class)->name('tabla-venta-clientes');
            Route::get('/sistema/pagina/tabla-venta-entregas', AccountSettingProfile::class)->name('tabla-venta-entregas');
            Route::get('/sistema/pagina/registro-de-postulaciones-listado-de-postulaciones', SisCrudAplication::class)->name('registro-de-postulaciones');
            Route::get('/sistema/pagina/registro-de-postulaciones/show/{id}', [SisValidacionAplication::class, 'render'])->name('registro-de-postulaciones.show');
            Route::get('aplication/editar/{aplicationId}', 'App\Http\Livewire\SisValidacionAplication@editar_aplication')->name('aplication.editar');
            Route::put('aplication/editar/{aplicationId}', 'App\Http\Livewire\SisValidacionAplication@guardar_edicion_aplication')->name('aplication.guardar_edicion');
            Route::Resource('aplication', SisCrudAplication::class);
            Route::get('/sistema/pagina/registro-de-ventas-pagos-yape', AccountSettingProfile::class)->name('registro-de-ventas-pagos-yape');
            Route::get('/sistema/pagina/registro-de-ventas-productos-vendidos', AccountSettingProfile::class)->name('registro-de-ventas-productos-vendidos');

            Route::get('/sistema/pagina/registro-de-compras-listado-de-compras', AccountSettingProfile::class)->name('registro-de-compras');
            Route::get('/sistema/pagina/registro-de-compras-pagos-yape', AccountSettingProfile::class)->name('registro-de-compras-pagos-yape');
            Route::get('/sistema/pagina/registro-de-compras-productos-comprados', AccountSettingProfile::class)->name('registro-de-compras-productos-comprados');

            // REPORTES
            Route::get('/empresas/pdf', [SisCrudEmpresa::class, 'createPDF']);
            Route::get('/empresas/csv', [SisCrudEmpresa::class, 'createCSV']);
            Route::get('/empresas/excel', [SisCrudEmpresa::class, 'createEXCEL']);
            Route::get('/ofertas_laborales/pdf', [SisCrudOfertaLaboral::class, 'createPDF']);
            Route::get('/ofertas_laborales/csv', [SisCrudOfertaLaboral::class, 'createCSV']);
            Route::get('/ofertas_laborales/excel', [SisCrudOfertaLaboral::class, 'createEXCEL']);

            //PAGES
            Route::get('/postulacion/{id}', PagePostulacion::class)->name('detalle.postulacion');
            Route::post('/grabar_postulacion_postulacion', [PagePostulacion::class, 'save'])->name('grabar.postulacion_result');

            Route::get('/postulante/{id}', PagePostulante::class)->name('postulante');
        });
    }
);
Route::get('/resultado-de-postulacion/{id}', PageResulPostulacion::class)->name('resultado.postulacion');
//PAGES
// Route::get('/postulacion/{id}',PagePostulacion::class)->name('detalle.postulacion');
Route::get('/ruta-al-endpoint', [PageBolsaLaboral::class, 'obtenerDetallesOferta']);

require_once __DIR__ . '/jetstream.php';
require_once __DIR__ . '/fortify.php';
