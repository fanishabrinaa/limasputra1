<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Tentang Kami - Putra Limas')]
class TentangKami extends Component
{
    public function render()
    {
        return view('livewire.tentang-kami', [
            'hero_desc' => Setting::get('tentang_hero_desc'),
            'sejarah_1' => Setting::get('tentang_sejarah_1'),
            'sejarah_2' => Setting::get('tentang_sejarah_2'),
            'milestones' => Setting::getJson('tentang_milestones', []),
            'leaders' => Setting::getJson('tentang_leaders', []),
            'values' => Setting::getJson('tentang_values', []),
        ])->layout('layouts.app');
    }
}