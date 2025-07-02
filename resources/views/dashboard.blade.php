<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DayLog</title>

    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex bg-gray-100">

    @php
        $user = Auth::user();
    @endphp
    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow p-4 flex flex-col ">
    
    {{-- Profile Section --}}
    <div class="mt-20 text-center">
        
        {{-- Profile Picture --}}
        <div class="w-24 h-24 m-auto  mb-4">
            <img src="{{ $user->profile_picture ?? 'https://via.placeholder.com/150' }}" alt="Profile Picture" class="w-full h-full rounded-full object-cover border-2 border-gray-300">
        </div>

        {{-- Name & Email --}}
        <h2 class="text-lg font-semibold">{{ $user->name ?? 'Guest User' }}</h2>
        <p class="text-gray-500 text-sm mb-4">{{ $user->email ?? 'guest@example.com' }}</p>

        {{-- Actions --}}
        <div class="space-y-2">
            <a href="" class="block w-full bg-blue-500 text-white py-1 rounded hover:bg-blue-600">Edit Profile</a>
            <a href="" class="block w-full bg-green-500 text-white py-1 rounded hover:bg-green-600">View Logs</a>
            <a href="{{route('logout')}}" class="block w-full bg-red-500 text-white py-1 rounded hover:bg-red-600" >Logout</a>
        </div>
    </div>
    </aside>


    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">
        
        {{-- Top Navbar --}}
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <a href="" class="block bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600" >Create</a>
        </header>

        {{-- Page Content --}}
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    @vite('resources/js/app.js')
</body>
</html>
