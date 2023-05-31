<?php

namespace App\Http\Livewire\Dash\Menu;

use App\Models\Menu;
use App\Models\SubMenu;
use LivewireUI\Modal\ModalComponent;

class Form extends ModalComponent
{
    public $menu_id;
    public $menu_name;
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

    public function mount($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);

        $this->menu_id = $menu_id;
        $this->menu_name = $menu->name;
    }

    public function render()
    {
        return view('livewire.dash.menu.form');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function store()
    {
        $this->validate();

        SubMenu::create([
            'menu_id' => $this->menu_id,
            'sub_name' => $this->sub_name,
            'sub_url' => $this->sub_url
        ]);

        $this->closeModal();
        $this->emit('menuList');
    }
}
