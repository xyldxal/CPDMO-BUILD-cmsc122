<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GoogleSignInButton extends Component
{
    public $buttonText;

    public function __construct($buttonText = 'Sign in with Google')
    {
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('components.google-sign-in-button');
    }
}
