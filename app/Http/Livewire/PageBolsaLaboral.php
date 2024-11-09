<?php

namespace App\Http\Livewire;

use App\Models\OfertaLaboral;
use Livewire\Component;
use Illuminate\Http\Request;

class PageBolsaLaboral extends Component
{

    public $primerDetalle;
    public $search;
    public  $amount = 10;
    public $loadingMore = false;
    public $noMoreResults = false;


    public function handleClick()
    {
        $this->emit('iniciarPostulacion');
    }

    public function mount()
    {
        $this->primerDetalle = OfertaLaboral::where('state', 2)->first();
    }

    public function render()
    {

        $query = OfertaLaboral::query();
        $query->where(function ($q) {
            $q->where('titulo', 'like', '%' . $this->search . '%')
                ->orWhere('remuneracion', 'like', '%' . $this->search . '%')
                ->orWhere('ubicacion', 'like', '%' . $this->search . '%');
        });


        $ofertas = $query->latest('id')->take($this->amount)->get();
        if ($ofertas->count() < $this->amount) {
            $this->noMoreResults = true;
        }
        return view('pages.page-bolsa-laboral', compact('ofertas'));
    }

    public function cargarMas()
    {
        $this->loadingMore = true;
        $this->amount += 10;
        $totalOfertas = OfertaLaboral::count();
        if ($this->amount >= $totalOfertas) {
            $this->noMoreResults = true;
        }

        $this->loadingMore = false;
    }
    public function obtenerDetallesOferta($id)
    {
        $this->primerDetalle = OfertaLaboral::find($id);
    }
}
