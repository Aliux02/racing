<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Betters list</title>
    <style>
      body{
        height: 100vh;
      }
      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }
      td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }
      tr:nth-child(even) {
        background-color: #dddddd;
      }
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
      h1{
        text-align: center;
      }
      .backRefresh{
        
      }
      .filter{
        float: right;
      }
      .betters{
        grid-area:betters;
        
        
        float: left;
      }
      .horses{
        grid-area:horses;
        
        float: right;
      }
      .wrap{
        display: grid;
        grid-template-rows: auto;
        column-gap: 50px;
        grid-template-columns: 10px 1fr 1fr 10px;
        grid-template-areas:  
        " . betters horses . "
        
      }
    </style>
</head>
<body>
  <div class="backRefresh">
    <button><a href="{{route('better.index')}}">Refresh</a></button>
    <button><a href="{{route('home')}}">Back</a><br></button><br><br>
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

    <form action="{{route('better.winner')}}" method="get">
      
        @if (session()->has('horse_message'))
          <div class="alert alert-success">
            {{session()->get('horse_message')}}
          </div>
        @endif
        @if (session()->has('no_horses_message'))
          <div class="alert">
            {{session()->get('no_horses_message')}}
          </div>
        @endif
      
      <button type="submit">Play</button>
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

  <div class="horses">
    <h1>Horses</h1>
    <button><a href="{{route('horse.create')}}">Add new horse</a>
    </button><br><br><br>
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