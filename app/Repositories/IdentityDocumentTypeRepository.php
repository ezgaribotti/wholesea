<?php

namespace App\Repositories;

use App\Entities\IdentityDocumentType;
use App\Interfaces\IdentityDocumentTypeRepositoryInterface;

class IdentityDocumentTypeRepository extends Repository implements IdentityDocumentTypeRepositoryInterface
{
    public function __construct(IdentityDocumentType $type)
    {
        parent::__construct($type);
    }

    public function getByCountryId(int $countryId): object
    {
        return $this->entity->whereCountryId($countryId)->get();
    }
}
