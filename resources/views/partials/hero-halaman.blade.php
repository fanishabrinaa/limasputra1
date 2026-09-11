@php
    $gambarHero = \App\Models\Setting::get($settingKey);
@endphp

<div class="absolute inset-0 z-0 overflow-hidden">
    @if ($gambarHero)
        <img src="{{ Storage::url($gambarHero) }}"
             class="w-full h-full object-cover">
    @endif

    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/50 via-slate-950/70 to-slate-950"></div>
</div>