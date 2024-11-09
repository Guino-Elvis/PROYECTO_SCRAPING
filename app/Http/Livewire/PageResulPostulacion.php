<?php

namespace App\Http\Livewire;

use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class PageResulPostulacion extends Component
{


    public $aplications;

    public function mount($id)
    {
        $this->aplications = Application::findOrFail($id);


        if (!Auth::check()) {
            $this->emit('mostrarModal', '¡Para continuar, necesitas Iniciar Sesión!');
            return redirect('/login-bolsa');
        }
        if (Auth::user()->email_verified_at == null) {
            $this->emit('mostrarModalGmail', '¡Para continuar, necesitas verificar tu dirección de correo electrónico!');
            return view('auth.verify-email');
        }

        $this->emit('redirectToAplications',$this->aplications->id);
    }

    public function render()
    {
        return view('pages.page-resul-postulacion');
    }

    public function redirectToAplications($id)
    {
        return redirect()->route('resultado.postulacion', ['id' => $id]);
    }
}
