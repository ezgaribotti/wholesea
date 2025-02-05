<?php

namespace App\Interfaces;

interface IdentityDocumentTypeRepositoryInterface extends RepositoryInterface
{
    public function getByCountryId(int $countryId): object;
}
