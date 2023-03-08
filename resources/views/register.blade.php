<x-layout.layout>
  <div class="flex w-full gap-5 mt-14">

    <form action="{{ route('register') }}" method="POST" class="flex-[1]">
      @csrf
      @method('POST')
      <div class="flex flex-col max-w-sm">
        <label for="name">name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="border-b-2">
        @error('name')
          <p class="text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex flex-col xl:max-w-[100px]">
        <label for="number_type">Tipe Nomor</label>
        <select name="number_type" id="number_type" value="{{ old('number_type') }}" class="border-b-2"
          aria-label="Pilih tipe nomor">
          @foreach (App\Models\User::NUMBER_TYPES as $numberType)
            <option @selected(old('number_type') === $numberType) value="{{ $numberType }}">{{ $numberType }}</option>
          @endforeach
        </select>
        @error('number_type')
          <p class="text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex flex-col xl:max-w-[200px]">
        <label for="number">Nomor</label>
        <input type="number" name="number" id="number" value="{{ old('number') }}" class="border-b-2">
        @error('number')
          <p class="text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex flex-col">
        <label for="password">password</label>
        <input type="password" name="password" id="password" value="{{ old('password') }}" class="border-b-2">
        @error('password')
          <p class="text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex flex-col">
        <label for="password_confirmation">konfirmasi password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
          value="{{ old('password_confirmation') }}" class="border-b-2">
        @error('password_confirmation')
          <p class="text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <button type="submit">Daftar</button>
    </form>
    <div class="flex-[1] ml-8">
      <span>sudah punya akun? skilahkan <a href="{{ route('login') }}" class="text-blue-600 underline">login</a></span>
      <h1 class="text-3xl">Perpustakaan SMKN 8 Semarang</h1>
    </div>
  </div>
</x-layout.layout>
