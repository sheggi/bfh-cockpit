<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lesson;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index() {
        return auth()->user();
    }
}
