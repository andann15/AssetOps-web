@php $uid = 'logo-' . \Illuminate\Support\Str::random(8); @endphp
<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <clipPath id="{{ $uid }}">
            <polygon points="50,5 91,27.5 91,72.5 50,95 9,72.5 9,27.5"/>
        </clipPath>
    </defs>

    {{--
        S-shape construction method:
        Two large overlapping shapes clipped to hexagon create the S letter.

        - Upper piece: covers hex top-left + top + top-right side, terminating at center-right.
          The UNCOVERED lower-left triangle = upper C opening (facing lower-left).
        - Lower piece: covers hex bottom-right + bottom + bottom-left side, terminating at center-left.
          The UNCOVERED upper-right triangle = lower C opening (facing upper-right).
        Together = letter S.
    --}}

    <!-- Hexagon dark navy base -->
    <polygon points="50,5 91,27.5 91,72.5 50,95 9,72.5 9,27.5" fill="#0d1f4e"/>

    <!-- ── UPPER part of S (top-left dominant, lighter navy) ──
         Shape: left-hex-vertex → top-left-edge → top-right-vertex → right-side down to y=50 → across to x=22 at y=50 → back to start
         Gap left at: triangle 9,27.5 → 9,50 → 22,50 (lower-left gap = upper C opening) -->
    <polygon
        points="9,27.5  50,5  91,27.5  91,50  22,50"
        fill="#1e40af"
        clip-path="url(#{{ $uid }})"
    />

    <!-- ── LOWER part of S (bottom-right dominant, darker navy) ──
         Shape: right-hex-vertex → bottom-right-edge → bottom-left-vertex → left-side up to y=50 → across to x=78 at y=50 → back to start
         Gap left at: triangle 91,72.5 → 91,50 → 78,50 (upper-right gap = lower C opening) -->
    <polygon
        points="91,72.5  50,95  9,72.5  9,50  78,50"
        fill="#1a4fa0"
        clip-path="url(#{{ $uid }})"
    />

    <!-- ── Orange accent (at top-right vertex area, the "hook" of S) ──
         Positioned at the top-right of the hex, matching the reference logo's orange arm -->
    <polygon
        points="78,18  91,27.5  84,40  70,32"
        fill="#f97316"
        clip-path="url(#{{ $uid }})"
    />
    <!-- Small orange circle cap at the top-right vertex -->
    <circle cx="91" cy="27.5" r="7" fill="#f97316"/>

    <!-- ── 3D Isometric Cube at center cross-point of S ──
         Cube positioned at y≈50 (S crossing point), three visible faces -->
    <!-- Top face (lightest) -->
    <polygon points="50,41 62,48 50,55 38,48" fill="#bfdbfe" clip-path="url(#{{ $uid }})"/>
    <!-- Left face -->
    <polygon points="38,48 50,55 50,66 38,59" fill="#3b82f6" clip-path="url(#{{ $uid }})"/>
    <!-- Right face (darkest) -->
    <polygon points="62,48 50,55 50,66 62,59" fill="#1d4ed8" clip-path="url(#{{ $uid }})"/>
</svg>