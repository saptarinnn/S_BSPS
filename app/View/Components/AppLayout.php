<?php

namespace App\View\Components;

use App\Models\Pengaturan;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function render(): View
    {
        return view('layouts.app', [
            'data' => Pengaturan::first(),
        ]);
    }
}
