<x-layout.layout>
  <div class="my-6 max-h-screen  overflow-y-scroll grid grid-cols-2 xl:p-2 xl:grid-cols-6 gap-5">
    @foreach ($books as $book)
      <x-admin-book-card :book="$book" class="col-span-1"></x-admin-book-card>
    @endforeach
  </div>
  <div class="mt-6 mb-4">
    {{ $books->links() }}
  </div>
</x-layout.layout>
