<?php

namespace Modules\Auth\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\src\Http\Requests\LoginRequest;
use Modules\Auth\src\Http\Resources\AccessTokenResource;
use Modules\Auth\src\Http\Resources\OperatorResource;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;

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
        if ($operator && Hash::check($request->password, $operator->password)) {
            if ($operator->status == 'suspended') {
                abort(403, 'Your account has been suspended.');
            }

            if ($operator->status == 'blocked') {
                abort(403, 'Your account has been blocked.');
            }
            $accessToken = $operator->createToken($request->ip())->plainTextToken;
            return response()->success(new AccessTokenResource($accessToken));
        }
        abort(401, 'The internal code or password is wrong.');
    }

    public function logout(Request $request): object
    {
        $request->user()->tokens()->delete();
        return response()->justMessage('Logged out successfully.');
    }

    public function currentOperator(Request $request): object
    {
        $operator = $request->user();
        return response()->success(new OperatorResource($operator));
    }
}
