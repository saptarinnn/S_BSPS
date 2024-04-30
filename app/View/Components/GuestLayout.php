<?php

namespace App\View\Components;

use App\Models\Pengaturan;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    public $title;

    public function __construct($title = '')
    {
        $this->title = $title.' // Booking Serive & Penjualan Sparepart Mobil';
    }

    public function render(): View
    {
        return view('layouts.guest', [
            'data' => Pengaturan::first(),
        ]);
    }
}
