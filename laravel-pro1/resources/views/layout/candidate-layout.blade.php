<!doctype html>
<html lang="en">
  <head>
    <title>Candidate Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
  </head>
  <body>
    <!-- trail -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Welcome :{{session()->get('id')}}</a>
    </nav>
    <!-- trail -->
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
        <div class="custom-menu">
          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
          </button>
        </div>
        <h1><a href="index.html" class="logo">Candidate Dashboard</a></h1>
        <ul class="list-unstyled components mb-5">
          <li>
            <a href="/dashboard"><span class="fa fa-user mr-3"></span> Dashboard</a>
          </li>
          <li class="active">
            <a href="/exams"><span class="fa fa-tasks mr-3"></span> Exams</a>
          </li>
          <li class="active">
            <a href="/results"><span class="fa fa-list mr-3"></span> Results</a>
          </li>
          <li>
            <a href="/logout"><span class="fa fa-sign-out mr-3"></span> Logout</a>
          </li>
        </ul>
      </nav>

      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        @yield('fillspace')
      </div>

      <script src="{{asset('js/jquery.min.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
      <script src="{{asset('js/popper.js')}}"></script>
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="{{asset('js/main.js')}}"></script>
    </body>
</html>
