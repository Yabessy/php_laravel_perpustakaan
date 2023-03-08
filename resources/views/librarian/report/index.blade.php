<x-layout.layout>
  <table class="w-full p-2 border-separate table-auto border-spacing-y-1">
    <thead>
      <tr>
        <th class="text-center">no</th>
        <th class="text-center">Nama - id</th>
        <th class="text-center">Tipe</th>
        <th class="text-center">Message</th>
      </tr>
    </thead>
    @php
      $no = 0;
    @endphp
    <tbody class="">
      @foreach ($reports as $report)
        @php $no++; @endphp
        <tr class="hover:bg-white">
          <td class="py-1 text-left border-b">{{ $no }}</td>
          <td class="py-1 text-center border-b">{{ $report->name }} - {{ $report->id }}</td>
          <td class="py-1 text-center border-b">{{ $report->type }}</td>
          <td class="py-1 text-center border-b">{{ $report->message }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</x-layout.layout>
