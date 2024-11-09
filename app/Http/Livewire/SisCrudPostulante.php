<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\postulante;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class SisCrudPostulante extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $isOpen = false;
    public $ruteCreate = false;

    public $search, $postulante;
    protected $listeners = ['render', 'delete' => 'delete'];
    protected $rules = [
        'postulante.email' => 'required',
        'postulante.phone' => 'required',
        'postulante.name' => 'required',
        'postulante.paterno' => 'required',
        'postulante.materno' => 'required',
        'postulante.address' => 'required',
        'postulante.postal' => 'required',
        'postulante.tdatos' => 'required',
    ];

    public function render()
    {
        $this->postulante['user_id'] = auth()->user()->id;

        $postulantes = postulante::where(function ($query) {
            $query->where('email', 'like', '%' . $this->search . '%')
                ->orwhere('phone', 'like', '%' . $this->search . '%')
                ->orwhere('name', 'like', '%' . $this->search . '%')
                ->orwhere('paterno', 'like', '%' . $this->search . '%')
                ->orwhere('materno', 'like', '%' . $this->search . '%')
                ->orwhere('address', 'like', '%' . $this->search . '%')
                ->orwhere('postal', 'like', '%' . $this->search . '%')
                ->orwhere('tdatos', 'like', '%' . $this->search . '%');
        })
            ->latest('id')
            ->paginate(10);
        return view('admin.pages.sis-crud-postulante', compact('postulantes'));
    }
}
