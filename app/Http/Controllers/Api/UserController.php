<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::first();
        // return new UserResource($users);

        $users = User::select(['id','name'])
        ->with(['favorites','comments','likePrompts'])
        // ->withCount(['favorites'])
    ->paginate(1);

        return new UserCollection($users);
    }
}
