<?php

namespace App\Http\Livewire\Grafico;

use App\Models\OfertaLaboral;
use Carbon\Carbon;
use Livewire\Component;

class Lineas extends Component
{
    public $meses = [];
    public $ofertasPorMes = [];

    public function mount()
    {
        // Obtener ofertas agrupadas por mes
        $ofertasPorMes = OfertaLaboral::selectRaw('YEAR(created_at) as anio, MONTH(created_at) as mes, COUNT(*) as total')
            ->groupBy('anio', 'mes')
            ->orderBy('anio')
            ->orderBy('mes')
            ->get();

        // Mapear los meses y los conteos
        $this->meses = $ofertasPorMes->map(function ($item) {
            return Carbon::create($item->anio, $item->mes)->format('F Y'); // Formato "Mes Año"
        })->toArray();

        $this->ofertasPorMes = $ofertasPorMes->pluck('total')->toArray();
    }

    public function render()
    {
        return view('livewire.grafico.lineas');
    }
}
