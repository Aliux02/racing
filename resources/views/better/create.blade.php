<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    <h1>Create new better</h1>
  <div class="table">
    <form action="{{route('better.store')}}" method="post">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name" value=""><br><br>
      <label for="surname">Surname:</label><br>
      <input type="text" id="surname" name="surname" value=""><br><br>
      <label for="bet">Bet:</label><br>
      <input type="text" id="bet" name="bet" value=""><br><br>

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