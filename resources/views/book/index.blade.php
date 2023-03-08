<x-layout.layout>
  <div class="max-h-screen p-2 overflow-y-scroll scrollbar-thin">
    <form action="/daftar_buku">
      <div class="relative m-4 border-2 border-gray-100 rounded-lg">
        <input type="text" name="search" class="z-0 w-full pl-10 pr-20 rounded-lg h-14 focus:shadow focus:outline-none"
          placeholder="Cari Buku.." value="{{ old('search') }}" />
        <div class="absolute top-2 right-2">
          <button type="submit" class="w-20 h-10 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
            Search
          </button>
        </div>
      </div>
      <select name="tags" id="">
        <option selected value="" class="p-2 text-white bg-blue-500 ">Pilih(kosong)</option>
        <option value="fantasy" class="p-2 text-white bg-blue-500 ">Fantasy</option>
        <option value="Horor" class="p-2 text-white bg-blue-500 ">Horor</option>
      </select>
      <select name="book_type" id="">
        <option selected value="" class="p-2 text-white bg-blue-500 ">Pilih(kosong)</option>
        <option value="0" class="p-2 text-white bg-blue-500 ">Non-Akademik</option>
        <option value="1" class="p-2 text-white bg-blue-500 ">Akademik</option>
      </select>
    </form>
    @foreach ($books as $array_books)
      @unless(count($array_books['items']) == 0)
        @if (isset($array_books['type']))
          <span class="flex items-center justify-between w-full text-2xl">{{ $array_books['type'] }} <a
              href="/daftar_buku/tipe/{{ $array_books['type'] }}" class="text-xl underline">Lainya</a></span>
        @endif
        <div class="grid max-h-screen grid-cols-4 gap-5 my-6 xl:p-2 xl:grid-cols-6">
          @foreach ($array_books['items'] as $book)
            <x-book-card :book="$book" class="col-span-1"></x-book-card>
          @endforeach
        </div>
      @else
        <p>tidak ada buku</p>
      @endunless
    @endforeach
  </div>
</x-layout.layout>
