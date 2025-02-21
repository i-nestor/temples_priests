<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller { // потом удалить этот файл
    public function TemplesByUser(User $author): View {
        return view('users.temples-by-user.blade', [
            "temples" => $author->temples->load('author'),
            "user"  => $author
        ]);
    }
}
