<x-layout.layout>
  <div x-data="{ open: false, total: 0, duration: 0 }" class="w-full h-full static p-2">
    <div
      class="flex justify-center items-center mx-auto mb-3 w-[150px] h-[200px] bg-gray-100 hover:shadow active:shadow-sm active:bg-gray-200">
      <img src="{{ $book->book_cover ? asset('storage/' . $book->book_cover) : asset('image/no-cover.png') }}"
        class="w-auto h-full object-contain" alt="">
    </div>
    <span class="text-base font-semibold">{{ $book->title }}</span>
    <h6>{{ $book->book_type ? 'Akademik' : 'Non-Akademik' }}, tersisa {{ $book->remaining_books ?? 0 }} buku</h6>
    <p class="text-sm ">{{ $book->synopsis }}</p>
    <div class="flex flex-col absolute bottom-3 left-3">
      <span>{{ $book->publisher }}</span>
      <span>{{ $book->author }}</span>
      <span>{{ $book->release_date }}</span>
    </div>
    <a href="{{ route('admin.books.edit', $book->id) }}" class="absolute bottom-3 right-3 bg-blue-300">
      Edit
    </a>
    <form action="{{ route('admin.books.destroy', $book->id) }}" method="post">
      @method('DELETE')
      @csrf
      <button type="submit" class="absolute bottom-3 right-10 bg-blue-300">
        Delete
      </button>
    </form>
  </div>
</x-layout.layout>
