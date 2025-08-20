<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- iconos de heroicon --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.1.5/outline.min.css" rel="stylesheet">

    {{-- linsk necesarios para usar Daysiui y tallwindcss  --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* Ajustar el ancho del navbar cuando el sidebar está abierto */
        .navbar-sidebar-open {
            width: calc(100% - 20rem);
            /* 20rem es el ancho del sidebar (w-80) */
        }

        /* En pantallas pequeñas, el navbar debe ocupar todo el ancho */
        @media (max-width: 1023px) {
            .navbar-sidebar-open {
                width: 100%;
            }
        }
    </style>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');
            sunIcon.classList.toggle('hidden', newTheme === 'dark');
            moonIcon.classList.toggle('hidden', newTheme === 'light');
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Theme initialization
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');
            sunIcon.classList.toggle('hidden', savedTheme === 'dark');
            moonIcon.classList.toggle('hidden', savedTheme === 'light');

            // Sidebar toggle for navbar adjustment
            const sidebarToggle = document.getElementById('sidebar');
            const navbar = document.getElementById('navbar');
            sidebarToggle.addEventListener('change', () => {
                if (sidebarToggle.checked) {
                    navbar.classList.add('navbar-sidebar-open', 'lg:translate-x-80');
                } else {
                    navbar.classList.remove('navbar-sidebar-open', 'lg:translate-x-80');
                }
            });
        });
    </script>

    @yield('head')
</head>

<body class="bg-base-200">
    <div class="drawer drawer-mobile">
        <input id="sidebar" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div id="navbar"
                class="navbar bg-base-100 shadow-lg fixed top-0 z-50 transition-all duration-300 left-0 right-0">
                <div class="flex-none">
                    <label for="sidebar" class="btn btn-square btn-ghost">
                        @include('svg.menu')
                    </label>
                </div>
                <div class="flex-1">
                    <a class="btn btn-ghost normal-case text-xl text-base-content">@yield('title')</a>
                </div>
                <div class="flex-none">
                    <button class="btn btn-ghost btn-circle" onclick="toggleTheme()">
                        @include('svg.sun')
                        @include('svg.moon')

                    </button>
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img src="{{ asset('img/dev.png') }}" alt="User Avatar" />
                            </div>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a>Perfil</a></li>
                            <li><a>Configuración</a></li>
                            <li><a>Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Main Content -->
            <main class="p-6 pt-20 min-h-screen">
                <div id="content" class="space-y-6 overflow-auto">
                    @yield('content')
                </div>
            </main>
        </div>
        <!-- Sidebar -->
        <div class="drawer-side z-50">
            <label for="sidebar" class="drawer-overlay"></label>
            <div class="flex flex-col justify-between p-4 w-80 bg-base-100 text-base-content h-full">
                <!-- Parte superior: Logo -->
                <div class="mb-4">
                    <h1 class="text-2xl font-bold text-base-content">SoftSemi</h1>
                </div>
                <!-- Navegación con scroll -->
                <div class="flex-1 overflow-y-auto space-y-4 pr-1">
                    <ul class="space-y-1">
                        <li><span class="menu-title">Gestion de semilleros y proyectos</span></li>
                        <li>
                            <a class="btn btn-ghost justify-start w-full text-left" href="{{route('modulos.semilleros.index')}}">
                                @include('svg.chemical')
                                Semilleros
                            </a>
                        </li>

                          <li>
                            <a class="btn btn-ghost justify-start w-full text-left" href="{{route('modulos.proyectos.index')}}">
                                @include('svg.chemical')
                                Proyectos de los semilleros
                            </a>
                        </li>
                  





                        <li><span class="menu-title">Gestion proyecto</span></li>
                        <li>
                            <a class="btn btn-ghost justify-start w-full text-left" href="{{route('modulos.integrantes.index')}}">
                                 @include('svg.users')
                                Integrantes de  proyecto
                            </a>
                        </li>


                               <li>
                            <a class="btn btn-ghost justify-start w-full text-left" href="{{route('modulos.proyecto_pertenesco.index')}}">
                                 @include('svg.users')
                                Los proyectos a los que perteneces
                            </a>
                        </li>


                        

                          <li>
                            <a class="btn btn-ghost justify-start w-full text-left" href="{{route('modulos.trabajos.index')}}">
                                @include('svg.chemical')
                                Trabajos de proyecto
                            </a>
                        </li>
                

                         <li><span class="menu-title">Eventos</span></li>
                        <li>
                            <a class="btn btn-ghost justify-start w-full text-left"
                                href="{{route('modulos.eventos.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-5">
                                    <path
                                        d="M10 2a.75.75 0 0 1 .75.75v5.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0L6.2 7.26a.75.75 0 1 1 1.1-1.02l1.95 2.1V2.75A.75.75 0 0 1 10 2Z" />
                                    <path
                                        d="M5.273 4.5a1.25 1.25 0 0 0-1.205.918l-1.523 5.52c-.006.02-.01.041-.015.062H6a1 1 0 0 1 .894.553l.448.894a1 1 0 0 0 .894.553h3.438a1 1 0 0 0 .86-.49l.606-1.02A1 1 0 0 1 14 11h3.47a1.318 1.318 0 0 0-.015-.062l-1.523-5.52a1.25 1.25 0 0 0-1.205-.918h-.977a.75.75 0 0 1 0-1.5h.977a2.75 2.75 0 0 1 2.651 2.019l1.523 5.52c.066.239.099.485.099.732V15a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3.73c0-.246.033-.492.099-.73l1.523-5.521A2.75 2.75 0 0 1 5.273 3h.977a.75.75 0 0 1 0 1.5h-.977Z" />
                                </svg>

                               Eventos
                            </a>
                        </li>


                          <li>
                            <a class="btn btn-ghost justify-start w-full text-left"
                                href="{{route('modulos.eventos.calendario')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-5">
                                    <path
                                        d="M10 2a.75.75 0 0 1 .75.75v5.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0L6.2 7.26a.75.75 0 1 1 1.1-1.02l1.95 2.1V2.75A.75.75 0 0 1 10 2Z" />
                                    <path
                                        d="M5.273 4.5a1.25 1.25 0 0 0-1.205.918l-1.523 5.52c-.006.02-.01.041-.015.062H6a1 1 0 0 1 .894.553l.448.894a1 1 0 0 0 .894.553h3.438a1 1 0 0 0 .86-.49l.606-1.02A1 1 0 0 1 14 11h3.47a1.318 1.318 0 0 0-.015-.062l-1.523-5.52a1.25 1.25 0 0 0-1.205-.918h-.977a.75.75 0 0 1 0-1.5h.977a2.75 2.75 0 0 1 2.651 2.019l1.523 5.52c.066.239.099.485.099.732V15a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3.73c0-.246.033-.492.099-.73l1.523-5.521A2.75 2.75 0 0 1 5.273 3h.977a.75.75 0 0 1 0 1.5h-.977Z" />
                                </svg>

                               calendarios
                            </a>
                        </li>
                      

                    </ul>
                </div>
                <!-- Configuración -->
                <div class="pt-4 border-t">
                    <a class="btn btn-ghost w-full justify-start text-left">
                        @include('svg.nut')
                        Configuración
                    </a>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer bg-base-100 text-base-content p-6  mt-8">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="avatar">
                    <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="{{ asset('img/dev.png') }}" alt="Andres Gonzalo Barrera Cortes">
                    </div>
                </div>
                <div>
                    <span class="font-semibold">Andres Gonzalo Barrera Cortes</span><br>
                    <a href="mailto:andresgbarrerac@gmail.com"
                        class="text-sm hover:underline">andresgbarrerac@gmail.com</a><br>
                    <span class="text-sm">+57 316 820 9707</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="avatar">
                    <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="{{ asset('img/dev.png') }}" alt="Jose Hernando Barreto">
                    </div>
                </div>
                <div>
                    <span class="font-semibold">Jose Hernando Barreto</span><br>
                    <a href="mailto:barrerogaitajosehernando@gmail.com"
                        class="text-sm hover:underline">barrerogaitajosehernando@gmail.com</a><br>
                    <span class="text-sm">+57 310 330 6516</span>
                </div>
            </div>
            <div class="text-center md:text-right mt-4 md:mt-0">
                <span class="block text-sm">© {{ date('Y') }} SENAEMPRESA</span>
                <span class="block text-xs text-base-content/60">Desarrollado con <span
                        class="text-primary">Laravel</span> & <span class="text-primary">DaisyUI</span> & <span
                        class="text-primary">tallwindcss</span></span>
            </div>
        </div>
    </footer>



    @yield('scripts')
</body>

</html>