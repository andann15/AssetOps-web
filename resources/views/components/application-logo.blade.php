<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <!-- Gradients to match the premium 3D look in the reference image -->
        <linearGradient id="blueGrad" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stop-color="#005ac8" />
            <stop offset="100%" stop-color="#00358a" />
        </linearGradient>
        <linearGradient id="orangeGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#fa9928" />
            <stop offset="100%" stop-color="#e86e04" />
        </linearGradient>
        <linearGradient id="darkBlueGrad" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stop-color="#002b6b" />
            <stop offset="100%" stop-color="#001233" />
        </linearGradient>
    </defs>

    <!-- 
      Geometric construction of the S-Hexagon:
      Center is at (50, 50). Outer radius R=44, Inner radius r=22.
    -->

    <!-- ORANGE POLYGON (Top-Right hook) -->
    <!-- Starts at top center, goes down-right, then inwards -->
    <polygon 
        points="50,6 88.105,28 88.105,32 69.053,43 69.053,39 50,28" 
        fill="url(#orangeGrad)" 
    />

    <!-- UPPER BLUE POLYGON (Left half of the S) -->
    <!-- Meets orange at top center, covers left edge, stops at the left gap -->
    <polygon 
        points="50,6 50,28 30.947,39 30.947,49 11.895,60 11.895,28" 
        fill="url(#blueGrad)" 
    />

    <!-- LOWER DARK BLUE POLYGON (Right & Bottom half of the S) -->
    <!-- Starts below the right gap, goes down to bottom, up to left gap -->
    <polygon 
        points="88.105,40 88.105,72 50,94 11.895,72 11.895,68 30.947,57 30.947,61 50,72 69.053,61 69.053,51" 
        fill="url(#darkBlueGrad)" 
    />

    <!-- CENTER 3D CUBE -->
    <!-- Top Face (Light Blue) -->
    <polygon points="50,41 57.794,45.5 50,50 42.206,45.5" fill="#2185f7" />
    <!-- Left Face (Medium Blue) -->
    <polygon points="42.206,45.5 50,50 50,59 42.206,54.5" fill="#0050c2" />
    <!-- Right Face (Dark Blue) -->
    <polygon points="50,50 57.794,45.5 57.794,54.5 50,59" fill="#003185" />
</svg>