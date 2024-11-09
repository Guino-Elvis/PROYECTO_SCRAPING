<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class TableUsers extends Component
{
    use WithPagination;

    public $isOpen = false, $isOpenAssign = false;
    public $ruteCreate = false;
    public $search, $user;
    public $amount = 5;
    public $listaRoles = [];
    protected $listeners = ['render', 'delete' => 'delete'];

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required',
        'user.apellido_p' => 'required',
        'user.apellido_m' => 'required',
        'user.dni' => 'required',
        'user.direccion' => 'required',
        'user.telefono' => 'required',
        'user.password' => 'nullable',
    ];

    public function render()
    {
        $this->user['user_id'] = auth()->user()->id;
        $roles = Role::all();
        $users = User::where('name', 'like', '%' . $this->search . '%')->latest('id')->paginate($this->amount);
        return view('admin.pages.table-users', compact('users', 'roles'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->ruteCreate = true;
        $this->reset('user');
        $this->resetValidation();
    }

    public function store()
{
    $this->validate();
    if (!isset($this->user['id'])) {
        // Crear nuevo usuario
        $user = User::create([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'apellido_p' => $this->user['apellido_p'],
            'apellido_m' => $this->user['apellido_m'],
            'dni' => $this->user['dni'],
            'direccion' => $this->user['direccion'],
            'telefono' => $this->user['telefono'],
            'password' => bcrypt($this->user['password']),
        ]);
        $this->emit('alert', 'Registro creado satisfactoriamente');
    } else {
        // Actualizar usuario existente
        $user = User::find($this->user['id']);
        $dataToUpdate = [
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'apellido_p' => $this->user['apellido_p'],
            'apellido_m' => $this->user['apellido_m'],
            'dni' => $this->user['dni'],
            'direccion' => $this->user['direccion'],
            'telefono' => $this->user['telefono'],
        ];
        // Solo actualizar la contraseña si fue modificada en el formulario
        if (!empty($this->user['password'])) {
            $dataToUpdate['password'] = bcrypt($this->user['password']);
        }
        $user->update($dataToUpdate);
        $this->emit('alert', 'Registro actualizado satisfactoriamente');
    }
    $this->reset(['isOpen', 'user']);
    $this->emitTo('SisCrudUser', 'render');
}


    public function edit($user)
    {
        $this->user = array_slice($user, 0, 10);
        $this->isOpen = true;
        $this->ruteCreate = false;
    }

    public function assignRole(User $user)
    {
        $this->user = $user;
        $this->listaRoles = $user->roles->pluck('id')->toArray();
        $this->isOpenAssign = true;
    }

    public function updateRoleUser(User $user)
    {
        $user->roles()->sync($this->listaRoles);
        $this->reset(['isOpenAssign', 'user']);
        $this->emit('alert', 'Se asignó correctamente los roles');
    }

    public function delete($id)
    {
        User::find($id)->delete();
    }
}
