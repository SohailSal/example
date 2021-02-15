<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function create()
    {
         $this->authorize('create',User::class);
    }

    public function edit(User $user)
    {
         $this->authorize('update', $user);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
    }
}
