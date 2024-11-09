<?php


namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\OfertaLaboral;
use App\Models\Postulante;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yoeunes\Toastr\Facades\Toastr;

class PagePostulante extends Component
{
    public $detalles;
    public $postulante;

    protected $rules = [
        'postulante.name' => 'required|string|max:255',
        'postulante.paterno' => 'required|string|max:255',
        'postulante.materno' => 'required|string|max:255',
        'postulante.phone' => 'required|numeric|min:7',
        'postulante.address' => 'required|string|max:255',
        'postulante.email' => 'required|email|max:255',
        'postulante.document' => 'required|string|max:20',
        'postulante.tdatos' => 'accepted',

    ];

    public function mount($id)
    {
        $this->detalles = OfertaLaboral::findOrFail($id);

        if (!Auth::check()) {
            Toastr::error('Para continuar, necesitas Iniciar Sesión', 'Error');
            return redirect('/login-bolsa')->with('message', '¡Para continuar, necesitas Iniciar Sesión!');
        }

        if (Auth::user()->email_verified_at == null) {
            Toastr::error('¡Para continuar, necesitas verificar tu dirección de correo electrónico!', 'Error');
            return view('auth.verify-email');
        }

        session(['postulacionIniciado' => true]);
        $this->emit('redirectToPostulacion', $this->detalles->id);
    }

    public function render()
    {
        $user = Auth::user();
        $this->postulante['email'] = $user->email;
        $this->postulante['phone'] = $user->telefono;
        $this->postulante['name'] = $user->names;
        $this->postulante['paterno'] = $user->apellido_p;
        $this->postulante['materno'] = $user->apellido_m;
        $this->postulante['document'] = $user->dni;
        $this->postulante['address'] = $user->direccion;
        $readOnly = ($user->email && $user->names && $user->telefono && $user->apellido_p && $user->apellido_m && $user->dni && $user->direccion);
        return view('pages.page-postulante', compact('readOnly'));
    }

    public function store(Request $request)
    {
        $this->validate();
        $postulante = Postulante::create($this->postulante);
        $this->emit('alert', 'Registro creado satisfactoriamente');
        $request->session()->put('postulante_datos', $postulante);

        // Mostrar notificación Toastr
        Toastr::success('Se guardó tu información satisfactoriamente', '¡Éxito!');
        return redirect()->route('detalle.postulacion', ['id' => $postulante['id']]);
    }

    public function redirectToPostulacion()
    {
        $postulante = $this->postulante;
        return redirect()->route('postulacion', ['id' => $postulante['id']]);
    }
}
