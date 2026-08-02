<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <!-- Hexagon dark navy base -->
    <polygon points="50,5 91,27.5 91,72.5 50,95 9,72.5 9,27.5" fill="#0d1f4e"/>

    <!-- Upper part of S (light blue) -->
    <!-- Start at top left (9, 27.5), go to top center (50, 5), go to top right (91, 27.5), go down right edge to (91, 50), go left to (22, 50), go back to top left (9, 27.5) -->
    <polygon points="9,27.5 50,5 91,27.5 91,50 22,50" fill="#1e40af"/>

    <!-- Lower part of S (medium blue) -->
    <!-- Start at bottom right (91, 72.5), go to bottom center (50, 95), go to bottom left (9, 72.5), go up left edge to (9, 50), go right to (78, 50), go back to bottom right (91, 72.5) -->
    <polygon points="91,72.5 50,95 9,72.5 9,50 78,50" fill="#1a4fa0"/>

    <!-- Orange accent hook -->
    <path d="M 82 22.5 L 91 27.5 L 91 42 L 78 36 Z" fill="#f97316"/>
    <circle cx="91" cy="27.5" r="5" fill="#f97316"/>

    <!-- 3D Cube -->
    <!-- Top face (lightest) -->
    <polygon points="50,41 62,48 50,55 38,48" fill="#bfdbfe" />
    <!-- Left face -->
    <polygon points="38,48 50,55 50,66 38,59" fill="#3b82f6" />
    <!-- Right face (darkest) -->
    <polygon points="62,48 50,55 50,66 62,59" fill="#1d4ed8" />
</svg>