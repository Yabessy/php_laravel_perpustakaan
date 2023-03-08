<x-layout.layout>
  <div class="flex justify-center items-center w-full h-full">
    <form action="/admin/books" enctype="multipart/form-data" method="POST"
      class="w-[840px] h-auto px-10 py-10 grid grid-cols-2 gap-2 items-center shadow-md border">
      @method('POST')
      @csrf
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='title'>Judul</label>
        <input type='text' id='title' name='title' required class="bg-gray-200 border-black border col-span-2">
      </div>
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='book_type'>Tipe Buku</label>
        <select id='book_type' name='book_type' required class="bg-gray-200 border-black border col-span-2">
          <option value="1">Akademik</option>
          <option value="0">Non-Akademik</option>
        </select>
      </div>
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='tags'>tags</label>
        <input type='text' id='tags' name='tags' required class="bg-gray-200 border-black border col-span-2">
      </div>
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='isbn'>Isbn</label>
        <input type='text' id='isbn' name='isbn' required class="bg-gray-200 border-black border col-span-2">
      </div>
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='release_date'>Release</label>
        <input type='date' id='release_date' name='release_date' required
          class="bg-gray-200 border-black border col-span-2">
      </div>
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='publisher'>Publisher</label>
        <input type='text' id='publisher' name='publisher' required
          class="bg-gray-200 border-black border col-span-2">
      </div>
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='author'>Author</label>
        <input type='text' id='author' name='author' required class="bg-gray-200 border-black border col-span-2">
      </div>
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='synopsis'>Synopsis</label>
        <textarea type='text' id='synopsis' name='synopsis' required class="bg-gray-200 border-black border col-span-2"></textarea>
      </div>
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='remaining_books'>Amount</label>
        <input type='number' id='remaining_books' name='remaining_books' required
          class="bg-gray-200 border-black border col-span-2">
      </div>
      <div class='flex flex-col gap-0.5 mb-3 col-span-1'>
        <label class="inline-block" for='book_cover'>Cover</label>
        <input type='file' id='book_cover' name='book_cover' class="">
      </div>
      <button type="submit">Buat</button>
    </form>
  </div>
</x-layout.layout>
