<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/edit_create.css') }}" rel="stylesheet">
    <title>Document</title>
    <style>

    </style>
</head>
<body style="background-image: url({{asset('img/foto.jpg')}})">
    @if ($errors->any())
        <div class="alert">
          <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
    @endif

    @if (session()->has('success_message'))
      <div class="alert alert-success">
        {{session()->get('success_message')}}
      </div>
    @endif

    @if (session()->has('info_message'))
    <div class="alert alert-info">
      {{session()->get('info_message')}}
    </div>
    @endif
    @if (session()->has('no_horses_choosen_message'))
    <div class="alert">
      {{session()->get('no_horses_choosen_message')}}
    </div>
  @endif

    <h1>Create new better</h1>
  <div class="table">
    <form action="{{route('better.store')}}" method="post">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name" value="{{old('name')}}"><br><br>
      <label for="surname">Surname:</label><br>
      <input type="text" id="surname" name="surname" value="{{old('surname')}}"><br><br>
      <label for="bet">Bet:</label><br>
      <input type="text" id="bet" name="bet" value="{{old('bet')}}"><br><br>

      <label for="horse">Horse:</label><br>
      <select name="horse_id" id="horse">
        @foreach ($horses as $horse)
          <option value="{{$horse->id}}">{{$horse->name}}</option>
        @endforeach
      </select>
      <br><br><br>
      <input type="submit" value="Submit"><br><br>
      <button><a href="{{route('better.index')}}">Back</a></button>
      @csrf
    </form>  
  </div>
  
</body>
</html>