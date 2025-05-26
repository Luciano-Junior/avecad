<div x-data="{ sidebarOpen: false, submenuOpen: false }">
    <div class="bg-gray-100 dark:bg-gray-900 text-gray-900">
        <div class="flex min-h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
                   class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 text-white transform transition-transform duration-200 ease-in-out md:translate-x-0 md:static md:inset-0">
              <div class="h-full flex flex-col">
                <div class="px-6 py-4 text-xl font-bold border-b border-gray-700 flex justify-between items-center">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-10 w-full fill-current text-gray-800 dark:text-green-200" />
                        </a>
                        <div class="ml-2">AVECAD</div>
                    </div>
                  <button class="md:hidden" @click="sidebarOpen = false">✕</button>
                </div>
          
                <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
                  <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                    🏠 <span class="ml-2">Dashboard</span>
                  </a>
          
                  <!-- Submenu -->
                  <div>
                    <button @click="submenuOpen = !submenuOpen"
                            class="w-full flex items-center justify-between px-3 py-2 rounded hover:bg-gray-700">
                      <span class="flex items-center">
                        👥 <span class="ml-2">Usuários</span>
                      </span>
                      <svg :class="submenuOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform"
                           fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                      </svg>
                    </button>
                    <div x-show="submenuOpen" x-cloak class="mt-2 ml-6 space-y-1">
                        <a class="block px-2 py-1 rounded hover:bg-gray-700 {{ request()->routeIs('associate.index') || request()->routeIs('dashboard') ? 'border-b-2 bg-gray-700':'' }}" href="{{route('associate.index')}}">
                            {{ __('Associates') }}
                        </a>
                      <a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Listar</a>
                      <a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Cadastrar</a>
                    </div>
                  </div>
          
                  <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                    ⚙️ <span class="ml-2">Configurações</span>
                  </a>
                </nav>
          
                <div class="px-6 py-4 border-t border-gray-700 text-xs text-center">
                  © 2025 - AVECAD
                </div>
              </div>
            </aside>
          
            <!-- Conteúdo principal -->
            <div class="flex-1 flex flex-col xs:ml-64">
              <!-- Navbar -->
              <header class="bg-gray-800 px-6 py-6 flex justify-between items-center shadow-md">
                <div class="flex items-center gap-4">
                  <button @click="sidebarOpen = true" class="md:hidden text-xl">
                    ☰
                  </button>
                </div>
                <div class="text-sm text-white">
                  <span class="mr-4">Olá, {{Auth::user()->name}}</span>
                  <button class="bg-gray-700 px-3 py-1 rounded hover:bg-gray-600">Sair</button>
                </div>
              </header>
          
              <!-- Page Content -->
                <main class="flex-1 overflow-auto" style="height: calc(100vh - 6rem);">
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-white dark:bg-gray-600 shadow">
                            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset
                    {{ $slot }}
                </main>
            </div>
          </div>
    </div>
</div>