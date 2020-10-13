@extends('forms.layout')

@section('content')
  <div class="w-full max-w-sm mx-auto mt-64">

    <form class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8" action="/payment/old/{{ $id }}" enctype='multipart/form-data' method="POST">
      @csrf
      <p class="text-xl font-bold mb-6">OLD pay</p>  
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="sum">
          Сумма оплаты
        </label>
        <input value="{{ old('sum') }}" required name="sum" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sum" type="number" placeholder="Введите сумму...">
        @error('sum')
          <p class="text-sm text-red-500">{{ $errors->first('sum') }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="payer_name">
          Имя плательщика
        </label>
        <input value="{{ old('payer_name') }}" required name="payer_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="payer_name" type="text" placeholder="Введите имя...">
        @error('payer_name')
          <p class="text-sm text-red-500">{{ $errors->first('payer_name') }}</p>
        @enderror
      </div>
      <div class="text-center">
        <button class="bg-teal-700 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Оплатить
        </button>
      </div>
    </form>
  </div>
@endsection
