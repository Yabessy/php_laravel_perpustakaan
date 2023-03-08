<x-layout.layout>
  <form action="/laporan" method="POST">
    @csrf
    @method('POST')

    @if ($errors->any())
      <div class="text-red-500">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif


    <input type="number" hidden name="user_id" value="{{ auth()->user()->id }}">
    <input type="text" hidden name="name" value="{{ auth()->user()->name }}">

    <h1>Kirimkan pesan pada kami</h1>

    <select name="type" id="type">
      <option value="Keluhan">Keluhan</option>
      <option value="Saran">Saran</option>
      <option value="Kritik">Kritik</option>
      <option value="Laporan">Laporan</option>
    </select>

    <div class='flex'>
      <label for='message'>message</label>
      <textarea rows="10" cols="20" type='message' id='message' name='message' required class="border">
      </textarea>
    </div>

    <button type="submit" class="">Kirim</button>
  </form>
</x-layout.layout>
