<div>
@props(['type' => 'success'])

@php
    // Define icons and colors based on type
    $icons = [
        'success' => '✔️',  // checkmark for success
        'danger'  => '❌',  // cross for error
        'warning' => '⚠️',  // warning sign
        'info'    => 'ℹ️',  // info sign
    ];

    $bgColors = [
        'success' => 'bg-success bg-opacity-25 text-success', // light green
        'danger'  => 'bg-danger bg-opacity-25 text-danger',   // light red
        'warning' => 'bg-warning bg-opacity-25 text-warning', // light yellow
        'info'    => 'bg-info bg-opacity-25 text-info',       // light blue
    ];
@endphp

<div {{ $attributes->merge(['class' => "alert $bgColors[$type] alert-dismissible d-flex align-items-center fade show"]) }} role="alert">
    <span class="me-2" style="font-size: 1.2rem;">{{ $icons[$type] ?? '' }}</span>
    <div>{{ $slot }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
