<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Betters list</title>
    <style>
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
    <button><a href="{{route('better.create')}}">Add new better</a></button>
    <button><a href="{{route('better.index')}}">Refresh</a></button>
    <button><a href="{{route('home')}}">Back</a><br></button>


    <form action="{{route('better.winner')}}" method="get">
      <p>
        @if (session()->has('horse_message'))
          <div class="alert alert-success">
            {{session()->get('horse_message')}}
          </div>
        @endif
      </p>
      <button type="submit">Play</button>
    </form>


    <h1>Betters</h1>

    <form action="{{route('better.sort')}}" method="get">

      <label for="horse">Filter betters by horse:</label>
      <select name="horse_id" id="horse">
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
</body>
</html>