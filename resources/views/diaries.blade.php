<div class="w-full mx-auto space-y-4 p-1">

    @foreach($diaries as $diary)
    <!-- Card Start -->
    <div class="bg-white shadow rounded p-4 mb-3 flex justify-between items-center">
        
        <div>
            <h2 class="text-gray-600 text-sm">{{ date('d-M-Y', strtotime($diary->day)) }}</h2>
            <h2 class="text-xl font-bold">{{$diary->title}}  </h2>
            <span class="inline-block bg-yellow-400 text-white text-xs px-3 py-1 rounded">{{$diary->tag}}</span>
        </div>

        <div class="space-x-2">
            <a href="{{route('edit-diary',$diary->id)}}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
            <a href="{{route('delete-diary',$diary->id)}}" onclick="return confirm('Are you sure you want to delete this diary entry?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</a>
            <a href="{{route('read-diary',$diary->id)}}" class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">Open</a>
        </div>

    </div>
    <!-- Card End -->
    @endforeach

    <div class="mt-1">
        {{$diaries->links()}}
    </div>

</div>
