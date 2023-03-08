<nav x-data="{ open: false }"
  class="z-40 flex flex-col justify-center fixed top-0 w-full max-w-[360px] xl:max-w-5xl mx-auto text-white">
  <div class="w-full h-[40px] bg-blue-400 px-3">
    <div class="flex justify-between items-center h-full">
      <a href="/" class="text-base font-bold text-white">Perpustakaan SMKN 8 Semarang</a>
      <div x-on:click="open = !open" class="flex space-x-2 text-sm xl:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 cursor-pointer">
          <path fill-rule="evenodd"
            d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
            clip-rule="evenodd" />
        </svg>
      </div>
      <ul class="gap-2 hidden xl:flex">
        @auth
          @if (auth()->user()->role === 'Pustakawan')
            <li><a href="/admin/dashboard">Dashboard Admin</a></li>
          @endif
          <li><a href="/daftar_buku">Daftar Buku</a></li>
          <li><a href="/history/1">Riwayat</a></li>

          </li>
          <li type="submit">{{ auth()->user()->name }} id:{{ auth()->user()->id }}</li>
          <li>
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Anda yakin ingin keluar?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-link nav-link" type="submit">Logout</button>
            </form>
          </li>
        @else
          <li><a href="/daftar_buku">Daftar Buku</a></li>
          <li>Halo Tamu</li>
        @endauth
        @guest
          <li><a href="{{ route('login') }}">login </a></li>
          <li><a href="{{ route('register') }}">register</a></li>
        @endguest
      </ul>
    </div>
  </div>
  <div class="w-full bg-blue-300 text-white hidden {{ request()->routeIs('history') ? 'lg:inline-flex' : 'hidden' }}">
    <ul class="w-full h-6 flex justify-around items-center">
      <li
        class="flex-1 text-center {{ request()->is('history/1') || request()->is('history') ? 'font-bold underline' : '' }}">
        <a href="/history/1">Periode yang akan datang</a>
      </li>
      <li class="flex-1 text-center {{ request()->is('history/2') ? 'font-bold underline' : '' }}"><a
          href="/history/2">Periode ini</a></li>
      <li class="flex-1 text-center {{ request()->is('history/3') ? 'font-bold underline' : '' }}"><a
          href="/history/3">Periode yang lalu</a></li>
    </ul>
  </div>
  <div class="w-full bg-blue-300 text-white {{ request()->routeIs('admin.lendings.index') ? '' : 'hidden' }}">
    <ul class="w-full h-6 flex justify-around items-center">
      <li class="flex-1 text-center {{ request()->filter == 0 ? 'font-bold underline' : '' }}"><a
          href="/admin/lendings?filter=0">ditolak</a></li>
      <li class="flex-1 text-center {{ request()->filter == 3 ? 'font-bold underline' : '' }}"><a
          href="/admin/lendings?filter=3">dikembalikan</a></li>
      <li class="flex-1 text-center {{ request()->filter == 2 ? 'font-bold underline' : '' }}"><a
          href="/admin/lendings?filter=2" class="">diterima</a></li>
      <li class="flex-1 text-center {{ request()->filter == 1 ? 'font-bold underline' : '' }}"><a
          href="/admin/lendings?filter=1">Belum Direspon</a></li>
    </ul>
  </div>
  <div x-cloak x-show="open" class="w-full bg-blue-300 xl:hidden">
    <ul class="list-none ml-2" x-data={open:false}>
      @auth
        <li type="submit">{{ auth()->user()->name }} id:{{ auth()->user()->id }}</li>

        @if (request()->routeIs('history'))
          <li><button x-show="open" x-on:click="open=!open">History v</button></li>
          <li><button x-show="!open" x-on:click="open=!open">History ></button></li>
        @else
          <li><a href="/history/1">Riwayat</a></li>
        @endif

        <li x-show="open" class="ml-2 flex flex-col">
          <a class="{{ request()->is('history/1') || request()->is('history') ? 'font-bold underline' : '' }}"
            href="/history/1">Periode yang akan datang</a>
          <a class="{{ request()->is('history/2') ? 'font-bold underline' : '' }}" href="/history/2">Periode ini</a>
          <a class="{{ request()->is('history/3') ? 'font-bold underline' : '' }}" href="/history/3">Periode yang
            lalu</a>
        </li>
        <a class="{{ request()->is('history/4') ? 'font-bold underline' : '' }}" href="/history/4">Denda</a>

        <li>
          <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Anda yakin ingin keluar?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-link nav-link" type="submit">Logout</button>
          </form>
        </li>
      @else
        <li>Halo Tamu</li>
      @endauth

      @guest
        <li><a class="" href="{{ route('login') }}">Login</a></li>
        <li><a class="" href="{{ route('register') }}">Register</a></li>
      @endguest
      <li><a href="/daftar_buku">Daftar Buku</a></li>
    </ul>
  </div>
</nav>
