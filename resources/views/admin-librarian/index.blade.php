<x-layout.layout>
  <a href="/admin/librarian/create" class="underline text-teal-700">Tambah pustakawan</a>
  @foreach ($librarian as $item)
    <div class="flex w-96 justify-around">
      <p>{{ $item->name }}</p>
      <form action="/admin/librarian/{{ $item->id }}" method="POST">
        @method('DELETE')
        @csrf
        <button class="text-red-500" type="submit">DELETE</button>
      </form>
    </div>
  @endforeach
</x-layout.layout>
