<!DOCTYPE html>
<html lang="en">
<head>
    <title>OnlineExam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Your Website</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ ('login') }}">Login</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <span class="nav-link">Welcome, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ ('account') }}">Account</a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ ('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="bg-dark">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <h1><a href="index.html" class="logo text-white">onlineExam</a></h1>
            <ul class="list-unstyled components mb-5">
                <li>
                    <a href="/alluser"><span class="fa fa-user mr-3"></span> Dashboard</a>
                </li>
                <li class="active">
                    <a href="/admin/dashboard"><span class="fa fa-book mr-3"></span> Subject</a>
                </li>
                <li class="active">
                    <a href="/admin/exam"><span class="fa fa-tasks mr-3"></span> Exams</a>
                </li>
                <li class="active">
                    <a href="/admin/question"><span class="fa fa-question-circle mr-3"></span> Q and A</a>
                </li>
                <li class="active">
                    <a href="/testpaper"><span class="fa fa-list mr-3"></span> Tests</a>
                </li>
                <li class="active">
                    <a href="/testAssignment"><span class="fa fa-user mr-3"></span> Test Assignment</a>
                </li>
                <li class="active">
                    <a href="/register"><span class="fa fa-user mr-3"></span> New Account</a>
                </li>
                <li>
                    <a href="/allcandidateresult"><span class="fa fa-bar-chart mr-3"></span> Result</a>
                </li>
                <li>
                    <a href="/logout"><span class="fa fa-sign-out mr-3"></span> Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('fillspace')
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
        <script src="{{asset('js/popper.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
    </div>
</body>
</html>
