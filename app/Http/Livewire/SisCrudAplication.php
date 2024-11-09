<?php

namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class SisCrudAplication extends Component
{
    use WithFileUploads;
    use WithPagination;



    public $search;

    public function render()
    {
        $userId = Auth::id();
        $user = User::find($userId);

        // Obtener los roles del usuario
        $roles = $user->roles->pluck('name')->toArray();

        // Inicializar la consulta de aplicaciones
        $query = Application::query();

        // Aplicar condiciones según los roles del usuario
        if (in_array('Administrador', $roles)) {
            // Si el usuario tiene el rol Administrador, mostrar todos los registros
            $query->where(function ($q) {
                $q->where('status', 'like', '%' . $this->search . '%')
                    ->orWhere('numero', 'like', '%' . $this->search . '%')
                    ->orWhere('fecha_postulacion', 'like', '%' . $this->search . '%')
                    ->orWhere('postulante_id', 'like', '%' . $this->search . '%')
                    ->orWhere('oferta_laboral_id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('postulante', function ($subquery) {
                        $subquery->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('paterno', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%')
                            ->orWhere('materno', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('oferta_laboral', function ($subquery) {
                        $subquery->where('titulo', 'like', '%' . $this->search . '%')
                            ->orWhere('ubicacion', 'like', '%' . $this->search . '%');
                    });
            });
        } elseif (in_array('Postulante', $roles)) {
            // Si el usuario tiene el rol Cliente, mostrar solo los registros del cliente
            $query->where('user_id', $userId);
        }

        // Aplicar búsqueda
        $query->where(function ($q) {
            $q->where('status', 'like', '%' . $this->search . '%')
                ->orWhere('numero', 'like', '%' . $this->search . '%')
                ->orWhere('fecha_postulacion', 'like', '%' . $this->search . '%')
                ->orWhere('postulante_id', 'like', '%' . $this->search . '%')
                ->orWhere('oferta_laboral_id', 'like', '%' . $this->search . '%')
                ->orWhereHas('postulante', function ($subquery) {
                    $subquery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('paterno', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('materno', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('oferta_laboral', function ($subquery) {
                    $subquery->where('titulo', 'like', '%' . $this->search . '%')
                        ->orWhere('ubicacion', 'like', '%' . $this->search . '%');
                });
        });

        // Obtener los resultados paginados
        $aplicaciones = $query->latest('id')->paginate(10);

        return view('admin.pages.sis-crud-aplication', compact('aplicaciones'));
    }


    public function destroy(string $id)
    {
        try {
            $aplicacion = Application::findOrFail($id);

            // Eliminar la empresa
            $aplicacion->delete();

            return redirect()
                ->back()
                ->with('success', '¡aplicacion eliminada exitosamente!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo eliminar la aplicacion.');
        }
    }


}
