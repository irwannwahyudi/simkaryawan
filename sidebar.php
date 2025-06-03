<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sidebar Toggle</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
</head>

<body class="flex h-screen bg-gray-100" x-data="{ sidebarOpen: true, openSubmenu: null }" x-cloak>
  <aside :class="sidebarOpen ? 'w-64' : 'w-16'"
    class="min-h-screen bg-gray-800 text-white flex flex-col transition-all duration-300 ease-in-out">

    <div class="flex items-center h-16 px-4 bg-gray-900 border-b border-gray-700 justify-between">
      <div class="flex items-center space-x-2">
        <img src="img/logo.png" alt="Logo" class="w-8 h-8">
        <div x-show="sidebarOpen" class="leading-tight">
          <span class="font-bold text-xs">KARYAWAN</span><br>
          <span class="text-xs">RSIY PDHI</span>
        </div>
      </div>
      <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none">
        ☰
      </button>
    </div>

    <div class="text-center my-3" x-show="sidebarOpen" x-cloak>
      <p class="mb-1 text-sm"><?= isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Pengguna'; ?></p>
      <span class="inline-block bg-green-600 text-white text-xs px-2 py-1 rounded-full">Administrator</span>
    </div>

    <nav class="flex-1 px-2 space-y-2 text-sm">
      <a href="index.php" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded">
        🏠 <span x-show="sidebarOpen" class="ml-2">Home</span>
      </a>

      <div>
        <button
          @click="openSubmenu = (openSubmenu === 'karyawan' ? null : 'karyawan')"
          class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-700 rounded">

          <div class="flex items-center">
            👥 <span x-show="sidebarOpen" class="ml-2">Karyawan</span>
          </div>
          <svg
            x-show="sidebarOpen"
            :class="{ 'rotate-90': openSubmenu === 'karyawan' }"
            class="w-4 h-4 transform transition-transform"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24">
            <path d="M9 5l7 7-7 7" />
          </svg>
        </button>


        <div
          x-show="openSubmenu === 'karyawan' && sidebarOpen"
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 max-h-0"
          x-transition:enter-end="opacity-100 max-h-40"
          x-transition:leave="transition ease-in duration-200"
          x-transition:leave-start="opacity-100 max-h-40"
          x-transition:leave-end="opacity-0 max-h-0"
          class="pl-6 mt-1 space-y-1 overflow-hidden"
          x-cloak>

          <a href="data_karyawan.php" class="block px-2 py-1 hover:bg-gray-700 rounded">Data Karyawan</a>
          <a href="tambah.php" class="block px-2 py-1 hover:bg-gray-700 rounded">Tambah Karyawan</a>
        </div>
      </div>


      <div>
        <button
          @click="openSubmenu = (openSubmenu === 'data_master' ? null : 'data_master')"
          class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-700 rounded">
          <div class="flex items-center">
            🗄️ <span x-show="sidebarOpen" class="ml-2">Data Master</span>
          </div>
          <svg
            x-show="sidebarOpen"
            :class="{ 'rotate-90': openSubmenu === 'data_master' }"
            class="w-4 h-4 transform transition-transform"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24">
            <path d="M9 5l7 7-7 7" />
          </svg>
        </button>

        <div
          x-show="openSubmenu === 'data_master' && sidebarOpen"
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 max-h-0"
          x-transition:enter-end="opacity-100 max-h-40"
          x-transition:leave="transition ease-in duration-200"
          x-transition:leave-start="opacity-100 max-h-40"
          x-transition:leave-end="opacity-0 max-h-0"
          class="pl-6 mt-1 space-y-1 overflow-hidden"
          x-cloak>
          <a href="registrasi.php" class="block px-2 py-1 hover:bg-gray-700 rounded">Tambah User</a>
        </div>
      </div>

      <a href="maintenance.php" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded">
        ⚙️ <span x-show="sidebarOpen" class="ml-2">Pengaturan</span>
      </a>
    </nav>

    <div class="px-4 py-2 border-t border-gray-700">
      <a href="logout.php" class="flex items-center text-red-400 hover:text-red-600">
        <span class="material-icons mr-2">logout</span>
        <span x-show="sidebarOpen">Log Out</span>
      </a>
    </div>
  </aside>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</body>

</html>