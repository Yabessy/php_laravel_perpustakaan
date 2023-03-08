<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Perpustakaan</title>
  <style>
    [x-cloak] {
      display: none;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>

<body class="w-[360px] xl:w-full xl:max-w-5xl mx-auto h-screen shadow-lg">
  <x-layout.navbar></x-layout.navbar>
  <main x-data="{ open: false, dateNow: new Date().toLocaleString(), search: '' }" class="w-full h-full max-w-[360px] xl:max-w-5xl max-h-screen mt-11 px-2 relative">
    {{ $slot }}
  </main>
  {{-- <x-layout.footer></x-layout.footer> --}}
  @if (session()->has('message') || $errors->any())
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 10000)" x-on:click="show =!show" x-show="show"
      class="fixed top-0 z-50 px-10 py-3 text-white transform -translate-x-1/2 bg-blue-500 cursor-pointer left-1/2">
      <p>{{ session('message') }}</p>
      <p>
      <div class="text-white">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      </p>
    </div>
  @endif
</body>

</html>
