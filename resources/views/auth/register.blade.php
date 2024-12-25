<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Byacht Services</title>
  <link rel="icon" href="{{ asset('assets/images/logo.webp') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md scale-95">
        <form method="POST" action="{{ route('register_post') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <div class="logo-img text-center">
                    <img src="{{ asset('assets/images/logo.webp') }}" class="w-[110px] m-auto">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-[#262360] text-[17px] font-bold mb-2" for="name">
                    Name
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                    id="name" type="name" name="name" placeholder="Enter your name"
                    value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-[#262360] text-[17px] font-bold mb-2" for="email">
                    Email
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                    id="email" type="email" name="email" placeholder="Enter your email"
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <label class="block text-[#262360] text-[17px] font-bold mb-2" for="password">
                    Password
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                    id="password" type="password" name="password" placeholder="******************" required>
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-[#262360] text-[17px] font-bold mb-2" for="password_confirmation">
                    Confirm Password
                </label>
                <input 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password_confirmation') border-red-500 @enderror"
                    id="password_confirmation" type="password" name="password_confirmation" placeholder="******************"
                    value="{{ old('password_confirmation') }}" required>
                @error('password_confirmation')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="pb-3">
                <p>If you already have an account please!! <a class="text-[#262360] font-bold underline"
                        href="{{ route('login') }}">Sign In</a></p>
            </div>
            <div class="flex items-center justify-center">
                <button
                    class="bg-[#262360] border hover:bg-white hover:text-[#262360] hover:border hover:border-[#262360] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transform transition-transform duration-300 ease-in-out hover:font-bold hover:scale-105"
                    type="submit">
                    Sign Up
                </button>
                {{-- @if (Route::has('password.request'))
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                @endif --}}
            </div>
        </form>

        <p class="text-center text-gray-500 text-xs">
            &copy;{{ date('Y') }} Byacht Services. All rights reserved.
        </p>
    </div>
</body>

</html>
