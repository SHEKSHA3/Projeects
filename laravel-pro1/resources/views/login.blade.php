@extends('layout.layout-comman')

@section('fillspace')

    <style>
        /* Add custom styles for the login form */
        body {
            background-image: url("https://previews.123rf.com/images/decorwithme/decorwithme1906/decorwithme190600154/128175869-online-exam-colorful-line-design-style-illustration-on-white-background-a-composition-with.jpg");
            background-size: cover;
            background-position: center;
            opacity:1;
            background-color: rgba(0, 0, 1, 1);
        }
        .login-form {
                width: 813px;
                margin: 0 auto;
                padding: 51px;
                background-color: #cac0c0;
                border-radius: 75px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                opacity:0.9;
                position:relative;
                top:10rem;
                z-index:10;
          }
          .login-form button[type="submit"] {
                width: 90%;
                padding: 10px;
                border-radius: 3px;
                border: none;
                background-color: #4CAF50;
                color: white;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
          }

    </style>
    
    <div class="login-form">
        <h1>Welcome online examination assessment </h1>

        <form method="post" action="{{route('userLogin')}}" clss="">
            @csrf

            <input type="email" name="email" placeholder="Enter your email">
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
            <br><br>
            <input type="password" name="password" placeholder="Enter your password">
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <br><br>

            <button type="submit">Login</button>

        </form>
        @if(Session::has('error'))
            <p class="session-error">{{Session::get('error')}}</p>
        @endif
    </div>

@endsection
