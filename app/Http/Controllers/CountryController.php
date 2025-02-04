<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use App\Interfaces\CountryRepositoryInterface;

class CountryController extends Controller
{
    public function __construct(
        protected CountryRepositoryInterface $countryRepository,
    )
    {
    }

    public function index(): object
    {
        $countries = $this->countryRepository->all();
        return response()->success(CountryResource::collection($countries));
    }
}
