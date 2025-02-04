<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreOperatorRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\Http\Resources\OperatorResource;
use App\Http\Resources\OperatorSummaryResource;
use App\Interfaces\OperatorRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    public function __construct(
        protected OperatorRepositoryInterface $operatorRepository
    )
    {
    }

    public function index(PaginateRequest $request): object
    {
        $operators = $this->operatorRepository->paginate($request);
        return response()->withPaginate(OperatorSummaryResource::collection($operators));
    }

    public function store(StoreOperatorRequest $request): object
    {
        $this->operatorRepository->create(
            array_merge($request->validated(), [
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

        return response()->success(OperatorResource::make($operator));
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
