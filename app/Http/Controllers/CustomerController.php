<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerSummaryResource;
use App\Interfaces\CustomerRepositoryInterface;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository
    )
    {
    }

    public function index(PaginateRequest $request): object
    {
        $customers = $this->customerRepository->paginate($request);
        return response()->withPaginate(CustomerSummaryResource::collection($customers));
    }

    public function store(StoreCustomerRequest $request): object
    {
        $this->customerRepository->create($request->validated());
        return response()->justMessage('Customer successfully created.');
    }

    public function show(string $id): object
    {
        $customer = $this->customerRepository->find($id);
        if (!$customer) {
            abort(404, 'Customer not found.');
        }
        return response()->success(CustomerResource::make($customer));
    }

    public function update(UpdateCustomerRequest $request, string $id): object
    {
        $this->customerRepository->update($request->validated(), $id);
        return response()->justMessage('Customer successfully updated.');
    }

    public function destroy(string $id): object
    {
        $this->customerRepository->delete($id);
        return response()->justMessage('Customer successfully deleted.');
    }
}
