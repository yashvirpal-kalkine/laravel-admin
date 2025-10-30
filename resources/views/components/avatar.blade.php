@props(['user', 'size' => 40])

@if ($user->profile_image_url)
    <img src="{{ $user->profile_image_url }}" 
         alt="{{ $user->name }}" 
         style="width:{{ $size }}px;height:{{ $size }}px;border-radius:50%;object-fit:cover;">
@else
    <div style="
        width:{{ $size }}px;
        height:{{ $size }}px;
        border-radius:50%;
        background:#4A5568;
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:700;
        text-transform:uppercase;
        font-size:{{ $size/2.2 }}px;">
        {{ $user->initials }}
    </div>
@endif

{{-- <x-avatar :user="$user" size="48" /> --}}
