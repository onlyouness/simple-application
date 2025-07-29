<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex-shrink-0">
          <a href="/" class="text-2xl font-bold text-blue-600">MySite</a>
        </div>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-4">
          
          <a href="/" class="py-2 px-4 <?= $requestUri == '/' ? 'bg-gray-500 text-white'  : 'text-gray-700' ?>   hover:text-blue-600">Home</a>
          <a href="<?= $UrlPrefix ?>/about" class="py-2 px-4 <?= $requestUri == '/about' ? 'bg-gray-500 text-white'  : 'text-gray-700' ?>  hover:text-blue-600">About</a>
          <a href="#" class="py-2 px-4 <?= $requestUri == '/services' ? 'bg-gray-500 text-white'  : 'text-gray-700' ?>  hover:text-blue-600">Services</a>
          <a href="#" class="py-2 px-4 <?= $requestUri == '/contact' ? 'bg-gray-500 text-white'  : 'text-gray-700' ?>  hover:text-blue-600">Contact</a>
        </nav>

        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button id="menu-toggle" class="text-gray-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
      <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Home</a>
      <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">About</a>
      <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Services</a>
      <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Contact</a>
    </div>
  </header>