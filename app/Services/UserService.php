<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function createUser(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function updateUser(User $user, array $data)
    {
        if (isset($data['image'])) {
            if ($user->hasMedia('avatars')) {
                $user->clearMediaCollection('avatars');
            }

            $user->addMedia($data['image']->getRealPath())->usingFileName($data['image']->getClientOriginalName())->toMediaCollection('avatars');
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function getUserByUsername(string $username): User
    {
        return User::where('username', $username)->firstOrFail();
    }

    public function destroyUser(User $user)
    {
        if ($user->image) {
            Storage::disk('public')->delete('images/'. $user->image);
        }

        $user->delete();

        return $user;
    }
}
