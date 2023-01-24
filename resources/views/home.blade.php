<!DOCTYPE html>
<html>
 <head>
  <title>Api Example</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Quotes</h3><br />

   @if(!isset(Auth::user()->email))
    <script>window.location="/login";</script>
   @endif
   <div>
   <button class="btn btn-primary" onclick='window.location.reload(true);'>Refresh</button>
   <a href="{{ url('/logout') }}" class="btn btn-danger">Logout</a>
   </div>
   <table class="table table-striped table-hover table-reflow">
    <thead>
        <tr>
            <th ><strong>Id</strong></th>
            <th ><strong>Quote</strong></th>
            <th ><strong>Date Time</strong></th>
        </tr>
    </thead>
    <tbody>
       @if(count($quotes) == 0)
       <tr class="text-center">
            <td colspan="3">no quotes to show!</td> 
       <tr>
       @endif
       @if(count($quotes) > 0)
       @foreach($quotes as $key => $quote)
       <tr class="text-center">
            <td>{{$quote['id']}}</td> 
            <td>{{$quote['name']}}</td> 
            <td>{{$quote['created_at']}}</td> 
       <tr>
        @endforeach
       @endif
    </tbody>
</table>
  </div>
 </body>
</html>