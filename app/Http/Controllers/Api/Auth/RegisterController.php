<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use \Symfony\Component\HttpFoundation\Response as Status; // see Details https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
use App\Services\UserService;
use App\Models\Role;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 一般ユーザーの新規登録
     */
    public function register(RegisterRequest $request) 
    {
        // 一般ユーザー新規作成
        try {
            $this->userService->register(
                $request->name,
                $request->email,
                $request->password,
                Role::where('type', '一般')->first()->id,
            );
            return response()->success('Registration succeeded');
        } catch (QueryException $e) {
            return response()->error('Registration failed', Status::HTTP_BAD_REQUEST);
        }
    }
}
