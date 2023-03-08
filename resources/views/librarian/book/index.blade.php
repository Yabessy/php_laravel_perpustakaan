<x-layout.layout>
  <div class="max-h-screen overflow-y-scroll">
    <form action="/admin/books">
      <div class="relative border-2 border-gray-100 m-4 rounded-lg">
        <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
          placeholder="Cari Buku.." value="{{ old('search') }}" />
        <div class="absolute top-2 right-2">
          <button type="submit" class="h-10 w-20 text-white rounded-lg bg-blue-500 hover:bg-blue-600">
            Search
          </button>
        </div>
      </div>
      <select name="tags" id="">
        <option selected value="" class="bg-blue-500 text-white p-2 ">Pilih(kosong)</option>
        <option value="fantasy" class="bg-blue-500 text-white p-2 ">Fantasy</option>
        <option value="Horor" class="bg-blue-500 text-white p-2 ">Horor</option>
      </select>
      <select name="book_type" id="">
        <option selected value="" class="bg-blue-500 text-white p-2 ">Pilih(kosong)</option>
        <option value="0" class="bg-blue-500 text-white p-2 ">Non-Akademik</option>
        <option value="1" class="bg-blue-500 text-white p-2 ">Akademik</option>
      </select>
      <a href="{{ route('admin.books.create') }}">Tambah Buku</a>
      @foreach ($books as $array_books)
        @unless(count($array_books['items']) == 0)
          @if (isset($array_books['type']))
            <span class="text-2xl w-full flex items-center justify-between">{{ $array_books['type'] }} <a
                href="/admin/books/types/{{ $array_books['type'] }}" class="text-xl underline">Lainya</a></span>
          @endif
          <div class="my-6 max-h-screen  grid grid-cols-2 xl:p-5 xl:grid-cols-6 gap-5">
            @foreach ($array_books['items'] as $book)
              <x-admin-book-card :book="$book" class="col-span-1"></x-admin-book-card>
            @endforeach
          </div>
        @else
          <p>tidak ada buku</p>
        @endunless
      @endforeach
  </div>
</x-layout.layout>
