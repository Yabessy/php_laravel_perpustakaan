<div class="hidden text-gray-400 bg-gray-400 border-gray-400"></div>
<div class="hidden text-blue-400 bg-blue-400 border-blue-400"></div>
<div class="hidden text-red-400 bg-red-400 border-red-400"></div>
<div class="hidden text-yellow-400 bg-yellow-400 border-yellow-400"></div>
<div class="hidden text-green-400 bg-green-400 border-green-400"></div>
<x-layout.layout>
  <div class="flex flex-col w-full max-h-screen gap-5 mt-16 overflow-y-scroll lg:mt-20 scrollbar-thin">
    @unless(count($history) == 0)
      @foreach ($history as $item)
        @php
          $co = '';
          switch ($item->status) {
              case 0:
                  $co = 'yellow-400';
                  break;
              case 1:
                  $co = 'gray-400';
                  break;
              case 2:
                  if ($item->end_of_lend < date('Y-m-d')) {
                      $co = 'red-400';
                      break;
                  }
                  $co = 'blue-400';
                  break;
              case 3:
                  $co = 'green-400';
                  break;
              default:
                  $co = '';
                  break;
          }
        @endphp
        <div class="flex flex-col w-full border-b-2 lg:h-44 lg:flex-row">
          <x-book-card :book="$item" class="lg:w-[30%] h-32 border-{{ $co }}">
          </x-book-card>
          <div class="lg:w-[55%] lg:mx-auto flex flex-col">
            {{-- <p class="text-sm font-semibold">id peminjaman: <span class="font-bold">{{ $item->id }}</span></p> --}}
            <p class="text-sm font-semibold"><span class="font-bold">{{ $item->amount }}</span>buah buku, dengan id buku
              {{ $item->book_id }}</p>
            <span>Periode:</span>
            <p class="text-xs"><span>{{ $item->start_of_lend }}</span> sampai <span>{{ $item->end_of_lend }}</span></p>
            <span class="text-sm font-semibold">{{ $item->name }}</span>
            <p class="text-sm font-semibold"><span class="font-bold text-{{ $co }}">
                @php
                  switch ($item->status) {
                      case 0:
                          echo 'DiTolak';
                          break;
                      case 1:
                          echo 'Belum Direspon';
                          break;
                      case 2:
                          if ($item->end_of_lend < date('Y-m-d')) {
                              echo 'DENDA';
                              break;
                          }
                          echo 'Diterima';
                          break;
                      case 3:
                          echo 'Dikembalikan';
                          break;
                      default:
                          echo '';
                          break;
                  }
                @endphp
            </p>
          </div>
        </div>
      @endforeach
    @else
      <p>tidak ada Riwayat</p>
    @endunless
  </div>
</x-layout.layout>
