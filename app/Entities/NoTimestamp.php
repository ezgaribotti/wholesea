<?php

namespace App\Entities;

abstract class NoTimestamp extends Entity
{
    public $timestamps = false;
}
