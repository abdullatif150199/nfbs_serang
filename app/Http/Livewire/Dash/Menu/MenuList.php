<?php

namespace App\Http\Livewire\Dash\Menu;

use App\Models\Menu;
use App\Models\SubMenu;
use Livewire\Component;

class MenuList extends Component
{
    public $menuList;
    public $menu_id = 2;

    protected $listeners = [
        'menuList' => '$refresh',
        'delete' => 'deleteSubmenu',
    ];

    public function mount()
    {
        $this->menuList = Menu::where('type', 'primary')->get();
    }

    public function render()
    {
        $submenuList = [];

        if ($this->menu_id) {
            $submenuList = SubMenu::where('menu_id', $this->menu_id)->get();
        }

        return view('livewire.dash.menu.menu-list', ['submenuList' => $submenuList]);
    }

    public function deleteSubmenu($id)
    {
        $submenu = SubMenu::findOrFail($id);
        $submenu->delete();
    }

    public function confirm($id, $method, $message)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => $message,
            'text' => '',
            'id' => $id,
            'method' => $method
        ]);
    }
}
