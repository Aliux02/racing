<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Horses list</title>
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
    <button><a href="{{route('horse.create')}}">Add new horse</a><br></button>
    <button><a href="{{route('horse.index')}}">Refresh</a><br></button>
    <button><a href="{{route('home')}}">Back</a><br></button>
    <h1>Horses</h1>
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
</body>
</html>