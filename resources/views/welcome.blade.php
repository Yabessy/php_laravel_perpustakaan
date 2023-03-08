<x-layout.layout>
  <h1 class="text-lg font-semibold">Perpustakaan</h1>
  <h1 class="text-lg font-semibold">Silahkan pilih opsi dibawah</h1>
  <div class="flex flex-col items-center mt-10 gap-y-5">
    <a href="/daftar_buku" class="border-2 w-[85%] h-36 flex flex-col justify-center items-center">
      <x-icon.book-open class="w-20"></x-icon.book-open>
      <span class="font-semibold">Daftar Buku</span>
    </a>
    <a href="/register" class="border-2 w-[85%] h-36 flex flex-col justify-center items-center">
      <x-icon.arrow-left-on-rectangle class="w-20"></x-icon.arrow-left-on-rectangle>
      <span class="font-semibold">Daftar / Masuk</span>
    </a>
    @auth
    <a href="/laporan" class="border-2 w-[85%] h-36 flex flex-col justify-center items-center">
      <x-icon.chat-bubble-left-right class="w-20"></x-icon.chat-bubble-left-right>
      <span class="font-semibold">Lapor / Bantuan</span>
    </a>
    @else
    <a href="/login" class="border-2 w-[85%] h-36 flex flex-col justify-center items-center">
      <x-icon.chat-bubble-left-right class="w-20"></x-icon.chat-bubble-left-right>
      <span class="font-semibold">Lapor / Bantuan</span>
    </a>
    @endauth
  </div>
</x-layout.layout>