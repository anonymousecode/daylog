<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DayLog</title>
    @vite('resources/css/app.css')
</head>
<body style="background-color: #FFF0E6;">
    <div class="min-h-screen flex items-center justify-center  px-4">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-3xl font-semibold mb-6 text-center">DayLog</h1>


    <form action="login" method="POST" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="Enter your email"
          required
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

      <div>
        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Enter password"
          required
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

      <button
        type="submit"
        class="w-full bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600 transition cursor-pointer"
      >
        Login
      </button>
        <p class="text-center">Not a user? <a href="/register"  class="text-orange-600">Register</a></p>
    </form>
  </div>
  @if (session('fail'))
    <script>
        alert('{{session('fail')}}')
    </script>
  @endif
</div>

</body>
</html>