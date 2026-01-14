<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Fixed Desktop Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <div class="sticky top-0 z-50 py-5 px-4 lg:px-14 shadow-sm" style="background-color:#2563eb; color: white;">

        <div class="flex items-center justify-between w-full">
   
            <div class="flex items-center gap-8">

                <a href="{{ route('landing') }}">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/img/Logo.png') }}" alt="Logo" class="w-20 lg:w-100">
                    </div>
                </a>
                

                <div class="hidden lg:flex items-center">
                    <ul class="flex items-center gap-6 font-medium text-base">
                        <li>
                            <a href="{{ route('landing') }}" 
                               class="{{ request()->is('/') ? 'text-primary' : '' }} hover:text-gray-400 transition-colors duration-200">
                                Beranda
                            </a>
                        </li>
                        @foreach (\App\Models\NewsCategory::all() as $category)
                        <li>
                            <a href="{{ route('news.category', $category->slug) }}" 
                               class="{{ request()->is($category->slug) ? 'text-primary' : '' }} hover:text-gray-400 transition-colors duration-200">
                                {{ $category->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
<!-- Desktop Search + Login - Right -->
<div class="hidden lg:flex items-center gap-4">
    <!-- Search -->
    <form method="GET" action="{{ route('search') }}" class="relative flex items-center">
        <input type="text" name="search" placeholder="Cari berita..." 
               class="border border-slate-300 rounded-full px-4 py-2 pl-8 w-64 text-sm font-normal focus:outline-none focus:ring-primary focus:border-primary text-black" />
        <button type="submit" class="absolute left-3">
            <img src="{{ asset('assets/img/search.png') }}" alt="search" class="w-4">
        </button>
    </form>

    <!-- Login Button -->
    <a
        href="{{ url('/admin/login') }}"
        class="px-5 py-2 rounded-full text-white font-semibold text-sm transition-all duration-200"
        style="background-color: #dc2626;"
        onmouseover="this.style.backgroundColor='#b91c1c'"
        onmouseout="this.style.backgroundColor='#dc2626'"
    >
        Login
    </a>

     <!-- Register Button -->
    <a href="{{ route('author.register') }}"
       class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-5 py-2 rounded-full transition">
        Register
    </a>
</div>
            
            <!-- Mobile Hamburger Button -->
            <button class="lg:hidden text-white text-2xl focus:outline-none" id="menu-toggle">
                <span id="hamburger-icon">☰</span>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="menu" class="hidden flex-col w-full mt-4" 
             style="transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out; overflow: hidden; max-height: 0; opacity: 0;">
            <ul class="flex flex-col items-start gap-4 font-medium text-base w-full pt-4">
                <li class="w-full">
                    <a href="{{ route('landing') }}" 
                       class="{{ request()->is('/') ? 'text-primary' : '' }} block py-2 hover:text-gray-400 transition-colors duration-200">
                        Beranda
                    </a>
                </li>
                @foreach (\App\Models\NewsCategory::all() as $category)
                <li class="w-full">
                    <a href="{{ route('news.category', $category->slug) }}" 
                       class="{{ request()->is($category->slug) ? 'text-primary' : '' }} block py-2 hover:text-gray-400 transition-colors duration-200">
                        {{ $category->title }}
                    </a>
                </li>
                @endforeach
                
                <!-- Search Mobile -->
                <li class="w-full mt-2">
                    <form method="GET" action="{{ route('search') }}" class="relative w-full flex items-center">
                        <input type="text" name="search" placeholder="Cari berita..." 
                               class="border border-slate-300 rounded-full px-4 py-2 pl-8 w-full text-sm font-normal focus:outline-none focus:ring-primary focus:border-primary text-black" />
                        <button type="submit" class="absolute left-3">
                            <img src="{{ asset('assets/img/search.png') }}" alt="search" class="w-4">
                        </button>
                    </form>
                </li>
                            <!-- Login Mobile -->
                <li class="w-full mt-3">
                    <a
                        href="{{ url('/admin/login') }}"
                        class="block w-full text-center py-2 rounded-full font-semibold text-white"
                        style="background-color: #dc2626;"
                    >
                        Login
                    </a>
                </li>
                <!-- Register Mobile -->
<li class="w-full mt-3">
    <a href="{{ route('author.register') }}"
       class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-full transition">
        Register
    </a>
</li>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const menu = document.getElementById('menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            let isMenuOpen = false;

            
            menuToggle.addEventListener('click', function() {
                if (!isMenuOpen) {
                    // Buka menu
                    menu.classList.remove('hidden');
                    menu.classList.add('flex');
                    setTimeout(() => {
                        menu.style.maxHeight = menu.scrollHeight + 'px';
                        menu.style.opacity = '1';
                    }, 10);
                    hamburgerIcon.innerHTML = '✕';
                    isMenuOpen = true;
                } else {
                    // Tutup menu
                    menu.style.maxHeight = '0';
                    menu.style.opacity = '0';
                    setTimeout(() => {
                        menu.classList.add('hidden');
                        menu.classList.remove('flex');
                    }, 300);
                    hamburgerIcon.innerHTML = '☰';
                    isMenuOpen = false;
                }
            });

         
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    menu.classList.add('hidden');
                    menu.classList.remove('flex');
                    menu.style.maxHeight = '0';
                    menu.style.opacity = '0';
                    hamburgerIcon.innerHTML = '☰';
                    isMenuOpen = false;
                }
            });

          
            const menuLinks = menu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024 && isMenuOpen) {
                        menu.style.maxHeight = '0';
                        menu.style.opacity = '0';
                        setTimeout(() => {
                            menu.classList.add('hidden');
                            menu.classList.remove('flex');
                        }, 300);
                        hamburgerIcon.innerHTML = '☰';
                        isMenuOpen = false;
                    }
                });
            });
        });
    </script>
</body>
</html>