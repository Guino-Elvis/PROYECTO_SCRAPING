<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SecurityRoles extends Component
{
    use WithPagination;

    public $isOpen = false, $isOpenAssign = false;
    public $ruteCreate = false;
    public $search, $role;
    public $listapermisos = [];
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'role.name' => 'required',
    ];

    public function render()
    {
        $roles = Role::latest('id')->paginate(10);
        $permissions = Permission::all();
        return view('admin.pages.security-roles', compact('roles','permissions'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->ruteCreate = true;
        $this->reset('role');
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();
        if (!isset($this->role['id'])) {
            $role = Role::create(['name' => $this->role['name']]);
            $this->emit('alert', 'Registro creado satisfactoriamente');
        } else {
            $role = Role::find($this->role['id']);
            $role->update(['name' => $this->role['name']]);
            $this->emit('alert', 'Registro actualizado satisfactoriamente');
        }
        $this->reset(['isOpen', 'role']);
        $this->emitTo('SecurityRoles', 'render');
    }

    public function edit($role)
    {
        $this->role = array_slice($role, 0, 5);
        $this->isOpen = true;
        $this->ruteCreate = false;
    }

    public function delete($id)
    {
        Role::where('id', $id)->delete();
    }

    public function assignRole(Role $role)
    {
        $this->role = $role;
        $this->listapermisos = $role->permissions->pluck('id')->toArray();
        $this->isOpenAssign = true;
    }

    public function updateRolePermissions(Role $role)
    {
        $role->permissions()->sync($this->listapermisos);
        $this->reset(['isOpenAssign', 'role']);
        $this->emit('alert', 'Se asignó correctamente los permisos');
    }
}
