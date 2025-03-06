<?php

namespace Modules\Customers\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Customers\src\Http\Requests\StoreCustomerAddressRequest;
use Modules\Customers\src\Http\Resources\CustomerAddressResource;
use Modules\Customers\src\Interfaces\CustomerAddressRepositoryInterface;

class CustomerAddressController extends Controller
{
    public function __construct(
        protected CustomerAddressRepositoryInterface $addressRepository,
    )
    {
    }

    public function index(Request $request): object
    {
        abort_if(!$request->customer_id, 422, 'Customer id is required.');

        $addresses = $this->addressRepository->getByCustomerId($request->customer_id);
        return response()->success(CustomerAddressResource::collection($addresses));
    }

    public function store(StoreCustomerAddressRequest $request): object
    {
        $this->addressRepository->create($request->validated());
        return response()->justMessage('Address successfully created.');
    }

    public function destroy(string $id): object
    {
        $this->addressRepository->delete($id);
        return response()->justMessage('Address successfully deleted.');
    }
}
