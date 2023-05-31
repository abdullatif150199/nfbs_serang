<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Post;

/**
 * view Composer
 */
class NavbarComposer
{
    public function compose(View $view)
    {
        $this->composeNavbar($view);
    }

    private function composeNavbar(View $view)
    {
        $info = Post::query()
            ->select(['title', 'slug', 'category_id', 'created_at'])
            ->info()
            ->published()
            ->latestFirst()
            ->first();

        $menus = Menu::query()
            ->with(['submenus:id,menu_id,sub_name,sub_url'])
            ->select(['id', 'name', 'url', 'type'])
            ->whereIn('type', ['primary', 'footer'])
            ->get();

        $primaryMenu = $menus->where('type', 'primary');
        $footerMenu = $menus->where('type', 'footer');

        $view->with([
            'info' => $info,
            'primaryMenu' => $primaryMenu,
            'footerMenu' => $footerMenu
        ]);
    }
}
