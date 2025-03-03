<?php

namespace Modules\Operators\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Operators\src\Http\Requests\StoreOperatorRequest;
use Modules\Operators\src\Http\Requests\UpdateOperatorRequest;
use Modules\Operators\src\Http\Resources\OperatorResource;
use Modules\Operators\src\Interfaces\OperatorRepositoryInterface;

class OperatorController extends Controller
{
    public function __construct(
        protected OperatorRepositoryInterface $operatorRepository,
    )
    {
    }

    public function index(): object
    {
        $operators = $this->operatorRepository->all();
        return response()->success(OperatorResource::collection($operators));
    }

    public function store(StoreOperatorRequest $request): object
    {
        $this->operatorRepository->create(array_merge($request->validated(), [
            'password' => Hash::make($request->password)
        ]));
        return response()->justMessage('Operator successfully created.');
    }

    public function show(string $id): object
    {
        $operator = $this->operatorRepository->find($id);
        if (!$operator) {
            abort(404, 'Operator not found.');
        }
        return response()->success(new OperatorResource($operator));
    }

    public function update(UpdateOperatorRequest $request, string $id): object
    {
        $operator = $this->operatorRepository->findOrFail($id);

        if ($operator->internal_code != $request->internal_code) {
            if ($this->operatorRepository->findByInternalCode($request->internal_code)) {
                abort(422, 'Internal code already exists.');
            }
        }

        if ($operator->email != $request->email) {
            if ($this->operatorRepository->findByEmail($request->email)) {
                abort(422, 'Email already exists.');
            }
        }

        $this->operatorRepository->update($request->validated(), $id);
        return response()->justMessage('Operator successfully updated.');
    }

    public function destroy(string $id): object
    {
        $this->operatorRepository->delete($id);
        return response()->justMessage('Operator successfully deleted.');
    }
}
