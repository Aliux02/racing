<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit menu</title>
    <style>
        .alert{
          background-color: red;
          width: 400px;
        }
        .alert-info{
          background-color: yellow;
          width: 400px;
        }
        .alert-success{
          background-color: green;
          width: 400px;
        }
        a{
          text-decoration: none;
        }
        .table{
          display: flex;
          justify-content:center;
          margin-top: 100px;
        }
        form{
          text-align: center;
        }
        h1{
          text-align: center;
          margin-top: 100px;
        }
    </style>
</head>
<body>

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
    <h1>Edit horse</h1>
    <div class="table">    
      <form action="{{route('horse.update',['horse'=>$horse])}}" method="post">
      <label for="name">name:</label><br>
      <input type="text" id="name" name="name" value="{{ old('name') == null ? $horse->name : old('name') }}"><br>
      <label for="runs">	runs:</label><br>
      <input type="text" id="runs" name="runs" value="{{ old('runs') == null ? $horse->runs : old('runs') }}"><br><br>
      <label for="wins">wins:</label><br>
      <input type="text" id="wins" name="wins" value="{{ old('wins') == null ? $horse->wins : old('wins') }}"><br><br>

      <label for="about">About:</label><br>
      <input type="text" id="about" name="about" value="{{$horse->about}}"><br><br>
  
      <input type="submit" value="Submit"><br><br>
      <button><a href="{{route('horse.index')}}">Back</a></button>
      @csrf
      </form>
    </div>
</body>
</html>