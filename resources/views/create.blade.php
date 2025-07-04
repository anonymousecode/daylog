<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DayLog</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4 py-3">
            <div class="text-xl font-bold text-orange-600">DayLog</div>
            <div>
                <a href="/dashboard" class="bg-orange-400 text-white p-2 rounded-md hover:bg-orange-500 transition">Go to Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex items-center justify-center bg-white shadow-md p-3 rounded mt-8">
    <div class="w-full px-4">
    <form action="create" method="post" class="space-y-6 w-full">
        @csrf

        <!-- Row with Title, Date, Tags Full Width -->
        <div class="flex flex-wrap gap-4 w-full">
            
            <!-- Title -->
            <div class="flex-1 min-w-[150px]">
                <label for="title" class="block text-gray-700 mb-1 font-medium">Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    placeholder="Enter title" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <!-- Date -->
            <div class="flex-1 min-w-[150px]">
                <label for="date" class="block text-gray-700 mb-1 font-medium">Date</label>
                <input 
                    type="date" 
                    name="date" 
                    id="date" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
            </div>

            <!-- Tags -->
            <div class="flex-1 min-w-[150px]">
                <label for="tags" class="block text-gray-700 mb-1 font-medium">Tags</label>
                <select 
                    name="tags" 
                    id="tags" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
                    <option value="work">Work</option>
                    <option value="personal">Personal</option>
                    <option value="travel">Travel</option>
                    <option value="other">Other</option>
                </select>
            </div>

        </div>

        <!-- Content Area Full Width -->
        <div>
            <label for="content" class="block text-gray-700 mb-1 font-medium">Content</label>
            <textarea 
                name="content" 
                id="content" 
                cols="30" 
                rows="10" 
                placeholder="Write your log here..." 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
            ></textarea>
        </div>

        <div class="flex justify-end">
            <button 
            type="submit" 
            class="flex justify-center bg-orange-500 text-white p-2 rounded-md hover:bg-orange-600 transition"
        >
            Save 
        </button>
        </div>

        
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
