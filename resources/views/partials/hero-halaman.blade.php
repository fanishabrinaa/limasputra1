@php
    $gambarHero = \App\Models\Setting::get($settingKey);
@endphp

<div class="absolute inset-0 z-0 overflow-hidden">
    @if ($gambarHero)
        <img src="{{ Storage::url($gambarHero) }}"
             alt=""
             class="w-full h-full object-cover brightness-110">
    @endif

    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/20 via-slate-950/40 to-slate-950/90"></div>
</div>