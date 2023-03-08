<x-layout.layout>
  <div x-data="{ open: false, total: 0, duration: 0 }" class="static w-full h-full p-2 overflow-y-scroll scrollbar-thin mt-14">
    <div
      class="flex justify-center items-center mx-auto mb-3 w-[150px] h-[200px] bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
      <img src="{{ $book->book_cover ? asset('storage/' . $book->book_cover) : asset('image/no-cover.png') }}"
        class="object-contain w-auto h-full" alt="">
    </div>
    <span class="text-base font-semibold">{{ $book->title }}</span>
    <h6>{{ $book->book_type ? 'Akademik' : 'Non-Akademik' }}, tersisa {{ $book->remaining_books ?? 0 }} buku</h6>

    {{-- <p id="synopsisFull" class="hidden text-sm">{{ $book->synopsis }}</p>
    <p id="synopsis" class="text-sm" onclick="synopsis"></p>
    @vite('resources/js/synopsis.js') --}}
    <p class="text-sm ">{{ $book->synopsis }}</p>

    <div class="flex justify-between mt-64">

      <div class="flex flex-col ">
        <span>{{ $book->publisher }}</span>
        <span>{{ $book->author }}</span>
        <span>{{ $book->release_date }}</span>
      </div>

      <div>
        @auth
          <button x-on:click="open= !open" class="mt-4 bg-blue-300">
            Pinjam
          </button>
        @else
          <a href="/login" class="mt-4 bg-blue-300">Pinjam</a>
        @endauth
        @auth
          <div x-show="open" class="absolute inset-0 bg-transparent backdrop-blur">
            <form method="POST" action="/lending"
              class="absolute inset-x-0 flex flex-col gap-3 px-6 py-3 bg-white shadow-md bottom-44 h-72">
              @csrf
              @method('POST')
              <span class="text-black cursor-pointer">
                <svg x-on:click="open= !open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </span>

              <input type="number" name="user_id" value="{{ auth()->user()->id }}" hidden>
              <input type="number" name="book_id" value="{{ $book->id }}" hidden>
              <input type="number" name="min" value="0" hidden>

              <div class='flex flex-col'>
                <label for='start'>Tanggal Peminjaman (M / D / Y)</label>
                <input id='start' type='date' name='start'
                  class="px-1 mt-2 border-2 rounded focus:outline-none focus:ring-0 " value="{{ date('Y-m-d') }}"
                  min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime(date('Y-m-d') . ' + 14 days')) }}" required>
              </div>
              <div class='relative flex flex-col'>
                <label for='duration'>Durasi Peminjaman (Hari)</label>
                <input x-bind:value="duration"
                  class="mt-1 text-center border cursor-pointer select-none focus:ring-0 focus:outline-none"
                  type='number' id='duration' name='duration' required>

                <span x-on:click="duration -= 10"
                  class="absolute bottom-0.5 left-0 select-none w-8 h-auto flex justify-center items-center cursor-pointer bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                      clip-rule="evenodd" />
                  </svg>
                  <p class="mb-0.5 text-sm">10</p>
                </span>
                <span x-on:click="duration--"
                  class="absolute bottom-0.5 left-9 select-none w-8 h-auto flex justify-center items-center cursor-pointer bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                      clip-rule="evenodd" />
                  </svg>
                  <p class="mb-0.5 text-sm">1</p>
                </span>

                <span x-on:click="duration++"
                  class="absolute bottom-0.5 right-9 select-none w-8 h-auto flex justify-center items-center cursor-pointer bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path
                      d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                  </svg>
                  <p class="mb-0.5 text-sm">1</p>
                </span>
                <span x-on:click="duration += 10"
                  class="absolute bottom-0.5 right-0 select-none w-8 h-auto flex justify-center items-center cursor-pointer bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path
                      d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                  </svg>
                  <p class="mb-0.5 text-sm">10</p>
                </span>
              </div>

              <div class='relative flex flex-col'>
                <label for='amount'>Jumlah Buku</label>
                <input x-bind:value="total" type='number' id='amount' name='amount' required readonly
                  class="mt-1 text-center border cursor-pointer select-none focus:ring-0 focus:outline-none">

                <span x-on:click="total -= 10"
                  class="absolute bottom-0.5 left-0 select-none w-8 h-auto flex justify-center items-center cursor-pointer bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                      clip-rule="evenodd" />
                  </svg>
                  <p class="mb-0.5 text-sm">10</p>
                </span>
                <span x-on:click="total--"
                  class="absolute bottom-0.5 left-9 select-none w-8 h-auto flex justify-center items-center cursor-pointer bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                      clip-rule="evenodd" />
                  </svg>
                  <p class="mb-0.5 text-sm">1</p>
                </span>

                <span x-on:click="total++"
                  class="absolute bottom-0.5 right-9 select-none w-8 h-auto flex justify-center items-center cursor-pointer bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path
                      d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                  </svg>
                  <p class="mb-0.5 text-sm">1</p>
                </span>
                <span x-on:click="total += 10"
                  class="absolute bottom-0.5 right-0 select-none w-8 h-auto flex justify-center items-center cursor-pointer bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path
                      d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                  </svg>
                  <p class="mb-0.5 text-sm">10</p>
                </span>

              </div>
              <button type="submit">Pinjam</button>
            </form>
          </div>
        @endauth
      </div>

    </div>
    @auth
      <form method="POST" action="/comment" class="mt-10">
        @csrf
        @method('POST')
        <input type="number" hidden name="book_id" value="{{ $book->id }}">
        <h1 class="text-xl">Komentar</h1>
        <input type="radio" name="rating" value="1" />1
        <input type="radio" name="rating" value="2" />2
        <input type="radio" name="rating" value="3" />3
        <input type="radio" name="rating" value="4" />4
        <input type="radio" name="rating" value="5" />5
        <input type="text" name="comment_message" class="border">
        <button type="submit">Kirim</button>
      </form>
    @endauth

    <div class="w-full">
      
    </div>
  </div>
</x-layout.layout>
