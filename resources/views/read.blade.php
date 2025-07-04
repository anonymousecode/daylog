<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Diary - Full Screen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4 py-3">
            <div class="text-xl font-bold text-orange-600">DayLog</div>
            <div>
                <a href="/dashboard" class="bg-orange-500 text-white p-2 rounded-md hover:bg-orange-600 transition">Go to Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 flex p-6">
        
        <div class="w-full bg-white shadow-lg rounded-lg p-8 relative">
            
            <!-- Edit Button -->
            <a href="{{route('edit-diary',$diary->id)}}" class="absolute top-8 right-8 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 text-sm rounded-md transition">
                Edit
            </a>

            <!-- Title -->
            <h2 class="text-4xl font-bold text-gray-800 mb-6">{{$diary->title}}</h2>

            <!-- Metadata -->
            <div class="text-sm text-gray-500 mb-6 space-x-6">
                <span><strong>Date:</strong>{{ date('d-M-Y', strtotime($diary->day)) }}</span>
                <span><strong>Created:</strong> {{ date('d-M-Y H:i', strtotime($diary->timestamp)) }}</span>
            </div>

            <!-- Tags -->
            <div class="mb-6 space-x-2">
                <span class="inline-block bg-yellow-400 text-white font-bold text-sm px-3 p-1 rounded">{{$diary->tag}}</span>
            </div>

            <!-- Content -->
            <div class="text-gray-700 leading-relaxed text-lg space-y-4">
                <p>
                    {{$diary->content}}
                </p>
            </div>

        </div>

    </main>

</body>
</html>
