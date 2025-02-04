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

    public function getByCountryId($id): object
    {
        return $this->entity->whereCountryId($id)->get();
    }
}
