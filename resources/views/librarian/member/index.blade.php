<x-layout.layout>
  <table class="w-full p-2 table-auto border-separate border-spacing-y-1">
    <thead>
      <tr>
        <th class="text-center">no</th>
        <th class="text-center">Nama - id</th>
        <th class="text-center">Type</th>
        <th class="text-center">Number</th>
        <th class="text-center">DENDA</th>
        <th class="text-center">Buku tidak kembali</th>
      </tr>
    </thead>
    @php
      $no = 0;
    @endphp
    <tbody class="">
      @foreach ($members as $member)
        @php $no++; @endphp
        <tr class="hover:bg-white">
          <td class="py-1 border-b text-left">{{ $no }}</td>
          <td class="py-1 border-b text-center">{{ $member->name }} - {{ $member->id }}</td>
          <td class="py-1 border-b text-center">{{ $member->number_type }}</td>
          <td class="py-1 border-b text-center">{{ $member->number }}</td>
          <td class="py-1 border-b text-center">
            {{ DB::table('lendings')->where('user_id', '=', $member->id)->where('end_of_lend', '<', date('Y-m-d'))->where('status', '=', 2)->count() }}
            x
          </td>
          <td class="py-1 border-b text-center">
            @php
              $lendings = DB::table('lendings')
                  ->where('user_id', '=', $member->id)
                  ->where('status', '=', 2)
                  ->where('end_of_lend', '<', date('Y-m-d'))
                  ->select('amount')
                  ->get();
              $amount = 0;
              foreach ($lendings as $lending) {
                  $amount += $lending->amount;
              }
            @endphp
            {{ $amount }} buku = Rp{{ $amount * 1 }}jt
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</x-layout.layout>
