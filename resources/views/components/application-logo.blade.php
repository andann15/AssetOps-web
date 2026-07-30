@php $uid = 'logo-' . \Illuminate\Support\Str::random(8); @endphp
<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <clipPath id="{{ $uid }}">
            <polygon points="50,5 91,27.5 91,72.5 50,95 9,72.5 9,27.5"/>
        </clipPath>
    </defs>

    <!-- Hexagon background: upper lighter, lower darker -->
    <polygon points="50,5 91,27.5 91,72.5 50,95 9,72.5 9,27.5" fill="#0a2d6e"/>
    <polygon points="50,5 91,27.5 91,50 9,50 9,27.5" fill="#1a4fa0" clip-path="url(#{{ $uid }})"/>

    <!-- S letter as a thick white curved stroke (two bezier arcs forming S), clipped to hex -->
    <!--
        Upper arc of S: starts upper-right → sweeps LEFT across top → ends at center
        Lower arc of S: starts at center → sweeps RIGHT across bottom → ends lower-left
        Together they form the letter S
    -->
    <path d="M 74,19 C 90,19 88,44 50,46 C 12,48 10,75 27,84"
          fill="none"
          stroke="rgba(255,255,255,0.92)"
          stroke-width="18"
          stroke-linecap="round"
          clip-path="url(#{{ $uid }})"/>

    <!-- Orange circle accent: top-right corner of hexagon -->
    <circle cx="88" cy="24" r="10" fill="#F97316"/>

    <!-- 3D Cube centered in the middle of the S cross-point -->
    <polygon points="50,42 62,49 50,56 38,49" fill="#93c5fd" clip-path="url(#{{ $uid }})"/>
    <polygon points="38,49 50,56 50,67 38,60" fill="#3b82f6" clip-path="url(#{{ $uid }})"/>
    <polygon points="62,49 50,56 50,67 62,60" fill="#1d4ed8" clip-path="url(#{{ $uid }})"/>
</svg>