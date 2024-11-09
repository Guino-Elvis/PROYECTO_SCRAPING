<?php

namespace App\Http\Livewire;

use App\Mail\ContactMail_yape;
use App\Models\Application;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
class SisValidacionAplication extends Component
{


    public function render($id)

    {
        $aplicationdetail = Application::findOrFail($id);
        $details = $aplicationdetail->postulante()->paginate(6);

        // Utiliza la propiedad $isOpen en lugar de definir una variable local $isOpen
        return view('admin.pages.sis-crud-aplication-show', compact('aplicationdetail', 'details'));
    }

        //edicion de formularios
        public function editar_aplication($aplicationId)
        {
            // Obtén el aplication existente para editar
            $aplication = Application::find($aplicationId);

            // Verifica si el aplication existe
            if ($aplication) {
                return view('admin.modals.aplication', compact('aplication'));
            } else {
                // Redirige con un mensaje de error si el aplication no se encuentra
                return redirect()->back()->with('mensaje', 'Error al editar el aplication. aplication no encontrado.');
            }
        }


        public function guardar_edicion_aplication(Request $request, $aplicationId)
        {
            // Obtén el aplication existente para editar
            $aplication = Application::find($aplicationId);

            // Verifica si el aplication existe
            if ($aplication) {
                // Actualiza los campos del aplication con los valores del formulario
                $aplication->status = $request->get('status');
                $aplication->save();



                if ($aplication->status == 'AP') {

                    $client = $aplication->postulante;
                    $postulacion = $aplication;

                    if (!$aplication->postulante) {
                        return redirect()->back()->with('error', 'Error al enviar el correo. Cliente no encontrado.');
                    }

                    // Guardar el cliente y el voucher en sesiones
                    Session::put('client', $client);
                    Session::put('postulacion', $postulacion);
                    $this->sendConfirmationEmail($client,$postulacion);
                }

                return redirect()->route('registro-de-postulaciones.show', ['id' => $aplicationId])->with('mensaje', 'aplication editado exitosamente.');
            } else {
                // Redirige con un mensaje de error si el aplication no se encuentra
                return redirect()->back()->with('mensaje', 'Error al editar el aplication. aplication no encontrado.');
            }
        }

        protected function sendConfirmationEmail($client,$postulacion)
        {
            // Verificar si existe información del cliente y del postulacion
            if ($client && $postulacion) {
                Mail::to($client->email)->send(new ContactMail_yape($postulacion));
            } else {
                return redirect()->back()->with('error', 'Error al enviar el correo de confirmación. Información faltante.');
            }
        }

}
