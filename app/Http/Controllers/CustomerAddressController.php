<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerAddressRequest;
use App\Http\Requests\UpdateCustomerAddressRequest;
use App\Http\Resources\CustomerAddressResource;
use App\Interfaces\CustomerAddressRepositoryInterface;

class CustomerAddressController extends Controller
{
    public function __construct(
        protected CustomerAddressRepositoryInterface $addressRepository,
    )
    {
    }

    public function store(StoreCustomerAddressRequest $request)
    {
        $this->addressRepository->create($request->validated());
        return response()->justMessage('Address successfully created.');
    }

    public function show(string $id)
    {
        $address = $this->addressRepository->find($id);
        if (!$address) {
            abort(404, 'Address not found.');
        }
        return response()->success(CustomerAddressResource::make($address));
    }

    public function update(UpdateCustomerAddressRequest $request, string $id)
    {
        $this->addressRepository->update($request->validated(), $id);
        return response()->justMessage('Address successfully updated.');
    }

    public function destroy(string $id)
    {
        $this->addressRepository->delete($id);
        return response()->justMessage('Address successfully deleted.');
    }
}
