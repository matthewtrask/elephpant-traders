<?php

namespace App;

class UserId
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function toInteger() : int
    {
        return (int) $this->id;
    }

    public function __toString() : string
    {
        return (string) $this->id;
    }
}