<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> DayLog</title>
    @vite('resources/css/app.css')
</head>
<body>
    @php
        $user = Auth::user();
    @endphp
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4 py-3">
            <div class="text-xl font-bold text-orange-600">DayLog</div>
            <div>
                <a href="/dashboard" class="bg-orange-500 text-white p-2 rounded-md hover:bg-orange-600 transition">Go to Dashboard</a>
            </div>
        </div>
    </nav>
    <div  class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            
            <h2 class="text-center text-2xl font-bold mb-6">Update Profile</h2>
            {{-- Profile Picture --}}
            <div class="w-24 h-24 mx-auto mb-4">
                <img src="{{ asset('storage/'.$user->profile_pic) ?? 'https://via.placeholder.com/150' }}" alt="Profile Picture" class="w-full h-full rounded-full object-cover border-2 border-gray-300">
            </div>

            {{-- Update Profile Form --}}
            <form action="{{route('update-profile')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Change Profile Picture Input -->
                <input 
                    type="file" 
                    name="profile_pic" 
                    accept="image/*" 
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600"
                />

                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{$user->name}}"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{$user->email}}"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                
                </div>

                <div>
                    <label for="bio" class="block text-gray-700 font-medium mb-1">Bio</label>
                    <input
                        type="text"
                        id="bio"
                        name="bio"
                        value="{{$user->bio}}"

                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">New Password (Optional)</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
            
                </div>

                <div>
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm New Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600 transition"
                >
                    Save Changes
                </button>
            </form>

        </div>
    </div>

     @if (session('success'))
    <script>
        alert("{{ session('success') }}")
        window.location =' {{route('dashboard')}}';

    </script>
    @endif

    @if (session('fail'))
        <script>
            alert("{{ session('fail') }}")
        </script>
    @endif
</body>
</html>
