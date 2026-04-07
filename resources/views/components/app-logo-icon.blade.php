<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" {{ $attributes }}>
    <defs>
        <!-- Gradiente principal -->
        <radialGradient id="sphere" cx="50%" cy="35%" r="65%">
            <stop offset="0%" stop-color="#d9f3fb" />
            <stop offset="40%" stop-color="#6ec1e4" />
            <stop offset="70%" stop-color="#1aa3cf" />
            <stop offset="100%" stop-color="#0b6fa4" />
        </radialGradient>

        <!-- Brillo -->
        <radialGradient id="highlight" cx="50%" cy="0%" r="60%">
            <stop offset="0%" stop-color="#ffffff" stop-opacity="0.75" />
            <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
        </radialGradient>
    </defs>

    <!-- Esfera -->
    <circle cx="100" cy="100" r="90" fill="url(#sphere)" />

    <!-- Brillo superior -->
    <ellipse cx="100" cy="60" rx="65" ry="30" fill="url(#highlight)" />

    <!-- Curva horizontal -->
    <path d="M15 75 
             C60 15, 140 15, 185 75
             C140 120, 60 120, 15 155
             C60 190, 140 190, 185 155" fill="none" stroke="white" stroke-width="7" stroke-linecap="round"
        stroke-linejoin="round" />

    <!-- Curva vertical -->
    <path d="M75 15 
             C15 60, 15 140, 75 185
             C120 140, 120 60, 155 15
             C190 60, 190 140, 155 185" fill="none" stroke="white" stroke-width="7" stroke-linecap="round"
        stroke-linejoin="round" />
</svg>