<?php

namespace App\Http\Livewire\Dash\Menu;

use App\Models\SubMenu;
use LivewireUI\Modal\ModalComponent;

class SubMenuEditForm extends ModalComponent
{
    public $submenu_id;
    public $sub_name;
    public $sub_url;

    protected $rules = [
        'sub_name' => 'required|max:100',
        'sub_url' => 'required'
    ];

    protected $messages = [
        'sub_name.required' => 'Nama submenu harus diisi!',
        'sub_name.max' => 'Submenu maksimal 100 karakter',
        'sub_url.required' => 'Nama sub_url tidak boleh kosong',
    ];

    public function mount($submenu_id)
    {
        $submenu = SubMenu::findOrFail($submenu_id);

        $this->submenu_id = $submenu->id;
        $this->sub_name = $submenu->sub_name;
        $this->sub_url = $submenu->sub_url;
    }

    public function render()
    {
        return view('livewire.dash.menu.sub-menu-edit-form');
    }

    public function update()
    {
        $this->validate();

        $submenu = SubMenu::findOrFail($this->submenu_id);

        $submenu->sub_name = $this->sub_name;
        $submenu->sub_url = $this->sub_url;

        $submenu->save();
        $this->closeModal();
        $this->emit('menuList');
    }
}
