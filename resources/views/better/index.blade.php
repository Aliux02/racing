<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <title>Betters and Horses list</title>
</head>
<body style="background-image: url({{asset('img/foto.jpg')}})">
<div class="header">
  <div class="backRefresh">
    <button><a href="{{route('better.index')}}">Refresh</a></button>
    <button><a href="{{route('home')}}">Back</a></button>
  </div>
</div>
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

    @if ($errors->any())
    <div class="alert">
      <ul class="list-group">
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
      @endif

      @if (session()->has('horse_message'))
        <marquee class="win-success" behavior="right" direction="">
          {{session()->get('horse_message')}}
        </marquee>
      @endif
      @if (session()->has('no_horses_message'))
        <div class="alert">
          {{session()->get('no_horses_message')}}
        </div>
      @endif

    <form class="play" action="{{route('better.winner')}}" method="get">
      

      
      <button class="btn-play" type="submit">Play</button>
    </form>


<div class="wrap">
  <div class="betters">
    <h1>Betters</h1>

    <button>
      <a href="{{route('better.create')}}">Add new better</a>
    </button>
    <form class="filter" action="{{route('better.sort')}}" method="get">
      <label for="horse">Filter betters by horse:</label>
      <select name="horse_id" id="horse">
        <option value="0">All</option>
        @foreach ($horses as $horse)
          <option value="{{$horse->id}}">{{$horse->name}}</option>
        @endforeach
      </select>
      <input type="submit" value="Submit"><br><br>
      @csrf
    </form>
    <table>
      <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Bet</th>
        <th>Bet win</th>
        <th>Over all win</th>
        <th>Horse</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      @foreach ($betters as $better)
      <tr>
        <td>{{$better->name}}</td>
        <td>{{$better->surname}}</td>
        <td>{{$better->bet}}</td>
        <td>{{$better->bet_win}}</td>
        <td>{{$better->overAll_win}}</td>
        <td>{{$better->horse['name']}}</td>
        <td>
          <a href="{{route('better.edit',$better)}}">Edit</a>
        </td>
        <td>
          <a href="{{route('better.destroy',$better)}}">Delete</a>
        </td>
      </tr>
      @endforeach
    </table>
  </div>


  <div class="horses">
    <h1>Horses</h1>
    <button><a href="{{route('horse.create')}}">Add new horse</a>
    </button><br><br>
    <table>
      <tr>
        <th>Name</th>
        <th>Runs</th>
        <th>Wins</th>
        <th>Coefficient</th>
        <th>About</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      @foreach ($horses as $horse)
      <tr>
        <td>{{$horse->name}}</td>
        <td>{{$horse->runs}}</td>
        <td>{{$horse->wins}}</td>
        <td>{{$horse->coefficient}}</td>
        <td>{{$horse->about}}</td> 
        <td><a href="{{route('horse.edit',$horse)}}">Edit</a></td>
        <td><a href="{{route('horse.destroy',$horse)}}">Delete</a></td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
</body>
</html>