@props(['title'])

<div class="card">
    @if(!empty($title))
        <h3 class="card-title">{{ $title }}</h3>
    @endif
    
    <div class="card-content">
        {{ $slot }}
    </div>
</div>
