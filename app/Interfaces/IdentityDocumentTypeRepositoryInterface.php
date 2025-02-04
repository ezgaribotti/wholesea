<?php

namespace App\Interfaces;

interface IdentityDocumentTypeRepositoryInterface extends RepositoryInterface
{
    public function getByCountryId($id): object;
}
