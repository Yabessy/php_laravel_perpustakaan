@props(['book'])

<a href="/admin/books/{{ $book->id }}" {{ $attributes->merge(['class' => 'border-2 p-1']) }}>
  <div class="mx-auto my-0.5 w-[90%] h-[85%] bg-gray-200 flex justify-center items-center">
    <img src="{{ $book->book_cover ? asset('storage/' . $book->book_cover) : asset('image/no-cover.png') }}"
      class="w-auto h-32 object-contain" alt="">
  </div>
  <p class="mx-auto my-0.5 w-[90%] truncate">{{ $book->title }}</p>
</a>
