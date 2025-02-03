<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AccessTokenResource;
use App\Http\Resources\OperatorResource;
use App\Interfaces\OperatorRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        protected OperatorRepositoryInterface $operatorRepository,
    )
    {
    }

    public function login(LoginRequest $request): object
    {
        $operator = $this->operatorRepository->findByInternalCode($request->internal_code);
        if ($operator) {
            if (Hash::check($request->password, $operator->password)) {
                if ($operator->status == 'suspended') {
                    abort(401, 'Your account has been suspended.');
                }
                if ($operator->status == 'blocked') {
                    abort(401, 'Your account has been blocked.');
                }
                $accessToken = $operator->createToken($request->ip())->plainTextToken;
                return response()->success(AccessTokenResource::make($accessToken));
            }
        }
        abort(401, 'The internal code or password is wrong.');
    }

    public function currentOperator(Request $request): object
    {
        $operator = $request->user();
        return response()->success(OperatorResource::make($operator));
    }

    public function logout(Request $request): object
    {
        $request->user()->tokens()->delete();
        return response()->justMessage('Logged out successfully.');
    }
}
