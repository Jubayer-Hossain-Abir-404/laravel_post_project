<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Project</title>
    {{-- this file is coming from public --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="/" class="p-3">Home</a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('posts') }}" class="p-3">Posts</a>
            </li>
        </ul>
        <ul class="flex items-center">
            {{-- @if (auth()->user()) --}}
            @auth
                <li>
                    <a href="" class="p-3">{{ auth()->user()->name }}</a>
                </li>
                <li>
                    {{-- <a href="{{ route('logout') }}" class="p-3">Logout</a> --}}
                    <form action="{{ route('logout') }}" method="post" class="inline">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @endauth
            {{-- @else --}}
            @guest
                <li>
                    <a href="{{ route('login') }}" class="p-3">Login</a>
                </li>
                <li>
                    {{-- this is a a way to use the route register --}}
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
            @endguest
            {{-- @endif --}}
            
            
            
        </ul>
    </nav>
    {{-- this will be used to set this layout 
    over other view files --}}
    @yield('content')
</body>
</html>