<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class SecurityPermissions extends Component
{
    use WithPagination;

    public $isOpen = false, $isOpenAssign = false;
    public $ruteCreate = false;
    public $search, $permission;
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'permission.name' => 'required',
    ];

    public function render()
    {
        $permissions = Permission::latest('id')->paginate(10);
        return view('admin.pages.security-permissions', compact('permissions'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->ruteCreate = true;
        $this->reset('permission');
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();
        if (!isset($this->permission['id'])) {
            $permission = Permission::create(['name' => $this->permission['name']]);
            $this->emit('alert', 'Registro creado satisfactoriamente');
        } else {
            $permission = Permission::find($this->permission['id']);
            $permission->update(['name' => $this->permission['name']]);
            $this->emit('alert', 'Registro actualizado satisfactoriamente');
        }
        $this->reset(['isOpen', 'permission']);
        $this->emitTo('SecurityPermissions', 'render');
    }

    public function edit($permission)
    {
        $this->permission = array_slice($permission, 0, 5);
        $this->isOpen = true;
        $this->ruteCreate = false;
    }

    public function delete($id)
    {
        Permission::where('id', $id)->delete();
    }
}
