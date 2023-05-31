<?php

namespace App\View\Components\Partials;

use App\Models\InfoHeader;
use App\Models\Menu;
use App\Models\Post;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $info;
    public $primaryMenu;
    public $footerMenu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->info = InfoHeader::query()
            ->select(['title', 'link'])
            ->first();

        $this->primaryMenu = Menu::query()
            ->with(['submenus:id,menu_id,sub_name,sub_url'])
            ->select(['id', 'name', 'url', 'type'])
            ->where('type', 'primary')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.partials.navbar');
    }
}
