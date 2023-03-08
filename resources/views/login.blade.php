<x-layout.layout>
  <div class="flex w-full gap-5 mt-14">
    <form action="{{ route('login') }}" method="POST" class="flex-[1]">
      @csrf
      @method('POST')

      <div class="flex flex-col max-w-sm">
        <label for="number">Nomor</label>
        <input type="number" name="number" id="number" value="{{ old('number') }}" class="border-b-2">
        @error('number')
          <p class="text-red-500">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex flex-col max-w-lg">
        <label for="password">password</label>
        <input type="password" name="password" id="password" value="{{ old('password') }}" class="border-b-2">
      </div>
      <div class="flex">
        <label for="remember" class="">Ingat saya</label>
        <input type="checkbox" name="remember" id="remember" class="cursor-pointer ml-2">
      </div>
      <button type="submit">Login</button>
    </form>
    <div class="flex-[1]">
      <span>belum punya akun? skilahkan <a href="{{ route('register') }}"
          class="text-blue-600 underline">register</a></span>
      <h1 class="text-3xl">Perpustakaan SMKN 8 Semarang</h1>
    </div>
  </div>
</x-layout.layout>
