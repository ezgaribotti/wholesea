<?php

namespace App\Http\Controllers;

use App\Http\Requests\JustCountryIdRequest;
use App\Http\Resources\IdentityDocumentTypeResource;
use App\Interfaces\IdentityDocumentTypeRepositoryInterface;

class IdentityDocumentTypeController extends Controller
{
    public function __construct(
        protected IdentityDocumentTypeRepositoryInterface $typeRepository,
    )
    {
    }

    public function index(JustCountryIdRequest $request): object
    {
        $types = $this->typeRepository->getByCountryId($request->country_id);
        return response()->success(IdentityDocumentTypeResource::collection($types));
    }
}
