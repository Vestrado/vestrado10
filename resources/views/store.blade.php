@extends('layout.app')

@section('sidebar-kanan')
    <div class="bg-[#1C1C1C] p-4 space-y-8 rounded-xl">
        @if(isset($islogin) && $islogin)
            <!-- Display user data if logged in -->
            <h2 class="text-xl font-bold text-white mb-2">
                User Details
            </h2>
            <p class="text-sm text-white">
                <strong>Welcome:</strong> {{ $data['firstName'] }}<br>
                <strong>Last Login:</strong> {{ $data['lastLoginDate'] }}<br>
                <p class="text-sm text-white">
                    <a href="{{ route('logout') }}" class="btn">Logout</a>
                </p>
                <!-- Add more fields as needed -->
            </p>
        @else
            <!-- Display login form if not logged in -->
            <form method="post" action="{{ route('login.process') }}">
                @csrf <!-- This directive is important for CSRF protection -->
                <h2 class="text-xl font-bold text-white mb-2">
                    Login
                </h2>
                <p class="text-sm text-white">
                    <span class="text-sm">Email</span><br>

                    <input type="text" name="email" value="" class="form-control" style="color:black;width:250px;height:30px;padding-left:5px;">
                </p>
                <br>
                <p class="text-sm text-white">
                    <span class="text-sm">Password</span><br>
                    <input type="password" name="password" value="" class="form-control" style="color:black;width:250px;height:30px;padding-left:5px;">
                </p>
                <br>
                <p class="text-sm text-white">
                    <button type="submit" class="btn">Submit</button>
                </p>
            </form>
        @endif
    </div>
@endsection
