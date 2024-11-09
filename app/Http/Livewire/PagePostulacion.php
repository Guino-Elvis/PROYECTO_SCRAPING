<?php

namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\OfertaLaboral;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yoeunes\Toastr\Facades\Toastr;

class PagePostulacion extends Component
{
    public $detalles;

    public function mount($id)
    {
        $this->detalles = OfertaLaboral::findOrFail($id);

        if (!Auth::check()) {
            $this->mostrarModal('¡postulacion agregado correactamente!');
            $this->emit('mostrarModal', '¡Para continuar, necesitas Iniciar Sesión!');
            return redirect('/login-bolsa');
        }

        if (Auth::user()->email_verified_at == null) {
            $this->emit('mostrarModalGmail', '¡Para continuar, necesitas verificar tu dirección de correo electrónico!');
            return view('auth.verify-email');
        }

        // Establecer la variable en la sesión
        session(['postulacionIniciado' => true]);
        // Emitir el evento para redirigir
        $this->emit('redirectToPostulacion', $this->detalles->id);
    }

    public function render()
    {
        $postulante = session('postulante_datos');
        return view('pages.page-postulacion', compact('postulante'));
    }

    public function save(Request $request)
    {

        $request->validate([
            'documentos' => 'required|mimes:pdf,doc,docx,txt|max:4048', // Permitir PDF, Word, TXT, tamaño máximo de 2MB
        ]);


        if (!Storage::disk('public')->exists('documentos')) {
            // Si la carpeta no existe, intentar crearla
            if (!Storage::disk('public')->makeDirectory('documentos')) {
                // Si no se pudo crear la carpeta, mostrar un mensaje de error y redirigir
                return back()->with('error', 'No se pudo crear la carpeta para los documentos.');
            }
        }
        $postulante = session('postulante_datos');
        $ultimoCnumero = Application::max('numero');

        if (!$ultimoCnumero) {
            $numero = 'IFP009000'; // Agregamos 'IFP' al principio si no hay número anterior
        } else {
            $numero_parte_numerica = intval(substr($ultimoCnumero, 3));
            $numero_parte_numerica++;
            $numero_parte_numerica = str_pad($numero_parte_numerica, 6, '0', STR_PAD_LEFT); // Cambiado 8 por 6
            $numero = 'IFP' . $numero_parte_numerica;
        }

        $documentos = $request->file('documentos');

        $documentosPath = $documentos->store('documentos', 'public');

        $postular = new Application();
        $postular->status = 'PE';
        $postular->numero = $numero;
        $postular->fecha_postulacion = $request->fecha_postulacion;
        $postular->documentos = $documentosPath;
        $postular->oferta_laboral_id = $request->oferta_laboral_id;
        $postular->user_id = $request->user_id;
        $postular->postulante_id = $postulante->id;
        $postular->save();

        $request->session()->put('postular_datos', $postular);

        if ($postular->id) {
            $statusMessage = 'Gracias! La postulación se ha realizado correctamente.';
            $statusType = 'success';
        } else {
            $statusMessage = 'Lo sentimos! La postulación no se pudo realizar.';
            $statusType = 'error';
        }

        $request->session()->put('statusMessage', $statusMessage);
        $request->session()->put('statusType', $statusType);
        // Mostrar notificación Toastr
        Toastr::success('Gracias! La postulación se ha realizado correctamente', '¡Éxito!');
        return redirect()->route('resultado.postulacion', ['id' => $postular->id]);
    }

    public function redirectToPostulacion($id)
    {
        return redirect()->route('postulacion', ['id' => $id]);
    }
}
