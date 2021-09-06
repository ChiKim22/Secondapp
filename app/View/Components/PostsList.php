<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostsList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $name = "Kim";
     public $posts;

    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.posts-list');
    }
}
