<?php

namespace App\Http\Livewire\Grafico;


use App\Models\OfertaLaboral;
use Livewire\Component;

class Torta extends Component
{


    public $companias = [];
    public $tortaCounts = [];

    public function mount()
    {
        // Obtener las compañías y sus datos correspondientes
        $ofertasPorCompania = OfertaLaboral::selectRaw('titulo, COUNT(*) as total')
            ->groupBy('titulo')
            ->orderBy('total', 'desc')
            ->get();

        // Mapeo de las compañías
        $this->companias = $ofertasPorCompania->pluck('titulo')->toArray();

        // Datos específicos de cada compañía
        $this->tortaCounts = $ofertasPorCompania->pluck('total')->toArray();
    }

    public function render()
    {
        return view('livewire.grafico.torta');
    }
}
