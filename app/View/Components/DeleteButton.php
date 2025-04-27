<?php
// app/View/Components/DeleteButton.php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteButton extends Component
{
    public $action;
    public $text;
    public $class;
    public $iconClass;

    public function __construct($action, $text = 'Delete', $class = '', $iconClass = 'h-5 w-5 mr-2')
    {
        $this->action = $action;
        $this->text = $text;
        $this->class = $class;
        $this->iconClass = $iconClass;
    }

    public function render()
    {
        return view('components.delete-button');
    }
}
