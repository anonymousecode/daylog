<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DayLog</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100 flex flex-col">

    @php
        $user = Auth::user();
    @endphp

    <!-- Top Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4 py-3">
            <div class="text-xl font-bold text-orange-600">DayLog</div>
            <div>
                 <a href="{{ route('create') }}" class="bg-orange-500 text-white px-3 py-2 rounded hover:bg-orange-600">Create</a>
                <a href="{{ route('logout') }}" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">Logout</a>
            </div>
        </div>
    </nav>

    <!-- 2-Column Layout: Sidebar + Main Content -->
    <div class="flex flex-1">

        <!-- Sidebar / Profile Section -->
        <aside class="m-2 w-64 bg-white shadow p-4 flex flex-col min-h-full">
            <div class="mt-8 text-center">

                <!-- Profile Picture -->
                <div class="w-24 h-24 mx-auto mb-4">
                    <img src="{{ $user->profile_pic ? asset('storage/'.$user->profile_pic) : 'https://via.placeholder.com/150' }}" alt="Profile Picture" class="w-full h-full rounded-full object-cover border-2 border-gray-300">
                </div>

                <!-- Name, Email, Bio -->
                <h2 class="text-lg font-semibold">{{ $user->name ?? 'Guest User' }}</h2>
                <p class="text-gray-500 text-sm mb-2">{{ $user->email ?? 'guest@example.com' }}</p>
                <p class="text-gray-600 text-sm mb-4">{{ $user->bio ?? 'No bio available.' }}</p>

                <!-- Actions -->
                <div class="space-y-2">
                    <a href="{{ route('edit-profile') }}" class="block w-full bg-yellow-400 text-white py-1 rounded hover:bg-yellow-500">Edit Profile</a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Main Page Content -->
            <main class="p-4">
                @include('diaries', ['diaries' => $diaries])
            </main>

        </div>

    </div>

</body>
</html>
