<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <!--
        Logo SIAP - Hexagonal S shape
        Inspired by the reference image:
        - Dark navy blue body (#0c3d8a, #0a2d6e)
        - Orange accent tip at top-right (#F97316)
        - Light blue inner cube 3D
        The shape traces an "S" letter inside a hexagon
    -->

    <!-- Top-left arm of S (light blue inner top) -->
    <path d="M 50 8 L 22 24 L 22 50 L 50 34 L 78 50 L 78 24 Z" fill="#1a4fa0"/>

    <!-- Connecting bridge (middle of S, dark) -->
    <path d="M 22 50 L 50 66 L 78 50 L 50 34 Z" fill="#0a2d6e"/>

    <!-- Bottom-right arm of S -->
    <path d="M 50 66 L 78 50 L 78 76 L 50 92 L 22 76 L 22 50 Z" fill="#0c3d8a"/>

    <!-- Orange accent: top-right corner tip -->
    <path d="M 78 24 L 92 32 L 92 50 L 78 50 Z" fill="#F97316"/>
    <circle cx="92" cy="32" r="7" fill="#F97316"/>

    <!-- 3D Cube in center of S -->
    <!-- Top face (lightest) -->
    <polygon points="50,42 61,48.5 50,55 39,48.5" fill="#60a5fa"/>
    <!-- Left face -->
    <polygon points="39,48.5 50,55 50,68 39,61.5" fill="#2563eb"/>
    <!-- Right face -->
    <polygon points="61,48.5 50,55 50,68 61,61.5" fill="#1a4fa0"/>
</svg>