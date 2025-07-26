<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// Import the Cloudinary PHP SDK
use Cloudinary\Cloudinary;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validation
        $validated = $request->validate([
            'name'         => 'sometimes|string|max:255',
            'email'        => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'bio'          => 'nullable|string|max:1000',
            'profile_pic'  => 'nullable|image|max:2048',
            'password'     => 'nullable|string|min:8|confirmed', // expects password_confirmation
        ]);

        // 2. Update the fields if present
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('bio')) {
            $user->bio = $request->bio;
        }

        // 3. Handle password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 4. Cloudinary image upload (using PHP SDK, not Facade)
        if ($request->hasFile('profile_pic')) {
            // Set up Cloudinary instance from .env
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
                'url' => [
                    'secure' => env('CLOUDINARY_SECURE', true),
                ]
            ]);

            $result = $cloudinary->uploadApi()->upload(
                $request->file('profile_pic')->getRealPath(),
                [
                    'folder'    => 'profile_picture',
                    'public_id' => (string)$user->id, // use user id as public_id
                    'overwrite' => true,
                ]
            );
            $user->profile_pic = $result['secure_url']; // You can also use $result['url']
        }

        // 5. Save changes
        $res = $user->save();

        // 6. Return response
        return back()->with($res ? 'success' : 'fail', $res ? 'Profile updated successfully' : 'Something went wrong, try again');
    }
}
