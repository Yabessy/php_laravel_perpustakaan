<div class="hidden text-white bg-white border-b-white"></div>
<div class="hidden text-blue-100 bg-blue-100 border-b-blue-100"></div>
<div class="hidden text-red-100 bg-red-100 border-b-red-100"></div>
<div class="hidden text-yellow-100 border-yellow-100 bg-yellow-100"></div>
<div class="hidden text-green-100 bg-green-100 border-b-green-100"></div>
<x-layout.layout>
  <div x-data="{ confirm: false, title: '', username: '', days: '', start: '', end: '', id: '', status: false, able: false, amount: '' }" class="w-full h-full relative mt-14">
    <form action="" method="get" class="mt-20 w-full">
      <div class="relative flex space-x-9  m-4 rounded-lg w-full">
        <input type="hidden" name="filter" value="{{ request()->filter }}">
        <input type="text" name="book_id"
          class="h-14 w-1/3 pl-10 border-2 border-gray-100 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
          placeholder="id buku..." value="{{ old('search') }}" />
        <input type="text" name="user_id"
          class="h-14 w-1/3 pl-10 border-2 border-gray-100 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
          placeholder="id user..." value="{{ old('search') }}" />
        <div class="absolute top-2 right-20">
          <button type="submit" class="h-10 w-20 text-white rounded-lg bg-blue-500 hover:bg-blue-600">
            Search
          </button>
        </div>
      </div>
    </form>
    <table class="w-full p-2 table-auto border-separate border-spacing-y-1">
      <thead>
        <tr>
          <th class="text-center">no</>
          <th class="text-center">Judul - Id</>
          <th class="text-center">Peminjam - Id</>
          <th class="text-center">Jumlah Buku</>
          <th class="text-center">Tanggal Peminjam</>
          <th class="text-center">Selesai Peminjam</>
        </tr>
      </thead>
      @php
        $no = 0;
      @endphp
      <tbody class="">
        @unless(count($lendings) == 0)
          @foreach ($lendings as $item)
            @php
              $no++;
              $co = '';
              switch ($item->status) {
                  case 0:
                      $co = 'yellow-100';
                      break;
                  case 1:
                      $co = 'white';
                      break;
                  case 2:
                      if ($item->end_of_lend < date('Y-m-d')) {
                          $co = 'red-400';
                          break;
                      }
                      $co = 'blue-100';
                      break;
                  case 3:
                      $co = 'green-100';
                      break;
                  default:
                      $co = '';
                      break;
              }
              $able = false;
              switch ($item->status) {
                  case 0:
                      $able = false;
                      break;
                  case 3:
                      $able = false;
                      break;
                  default:
                      $able = true;
                      break;
              }
            @endphp
            <tr class="hover:bg-white cursor-pointer bg-{{ $co }}"
              x-on:click="days= {{ strtotime($item->end_of_lend) - strtotime($item->start_of_lend) > 0
                  ? (strtotime($item->end_of_lend) - strtotime($item->start_of_lend)) / 86400
                  : 0 }}
            title='{{ $item->title }}' 
            username='{{ $item->name }}'
            start='{{ $item->start_of_lend }}'
            end='{{ $item->end_of_lend }}'
            id='{{ $item->id }}'
            status='{{ $item->status == 2 ? true : false }}'
            able='{{ $able }}'
            amount='{{ $item->amount }}'
            confirm= !confirm">
              <td class="py-1 border-b text-left">{{ $no }}</td>
              <td class="py-1 border-b text-center">{{ $item->title }} - {{ $item->book_id }}</td>
              <td class="py-1 border-b text-center">{{ $item->name }} - {{ $item->user_id }}</td>
              <td class="py-1 border-b text-center">{{ $item->amount }}</td>
              <td class="py-1 border-b text-center">{{ $item->start_of_lend }}</td>
              <td class="py-1 border-b text-center">{{ $item->end_of_lend }}</td>
            </tr>
          @endforeach
        @else
          <tr>
            <td>
              tidak ada data
            </td>
          </tr>
        @endunless
      </tbody>
    </table>
    <div x-show="confirm" x-on:click="confirm= !confirm"
      class="z-50 bg-white w-full h-full flex justify-center items-center absolute top-0 border">
      <div x-on:click="$event.stopPropagation()" class="w-[540px] border bg-white shadow-md p-5">
        <p class="text-center p-2">
          Konfirmasi permintaan Peminjaman Buku <span x-text="title" class="font-bold"></span> berjumlah <span
            x-text="amount" class="font-bold"></span> buku, oleh <span x-text="username" class="font-bold"></span>
          selama
          <span x-text="days" class="font-bold"></span> Hari dari
          tanggal <span x-text="start" class="font-bold"></span> sampai <span x-text="end" class="font-bold"></span>
        </p>
        <div x-show="able" class="w-full flex justify-around mt-5">
          <form action="/admin/lendings" method="POST">
            @method('PATCH')
            @csrf
            <input type="number" name="type" value="0" hidden>
            <input type="number" name="id" x-bind:value="id" hidden>
            <button type="submit"
              class="bg-blue-400 px-4 py-0.5 rounded shadow-md hover:shadow-sm hover:bg-blue-500 active:bg-blue-600">Tolak</button>
          </form>
          <form x-show="status" action="/admin/lendings" method="POST">
            @method('PATCH')
            @csrf
            <input type="number" name="type" value="2" hidden>
            <input type="number" name="id" x-bind:value="id" hidden>
            <button type="submit"
              class="bg-blue-400 px-4 py-0.5 rounded shadow-md hover:shadow-sm hover:bg-blue-500 active:bg-blue-600">Konfirmasi
              Pengembalian</button>
          </form>
          <form x-show="!status" action="/admin/lendings" method="POST">
            @method('PATCH')
            @csrf
            <input type="number" name="type" value="1" hidden>
            <input type="number" name="id" x-bind:value="id" hidden>
            <button type="submit"
              class="bg-blue-400 px-4 py-0.5 rounded shadow-md hover:shadow-sm hover:bg-blue-500 active:bg-blue-600">Terima</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-layout.layout>
