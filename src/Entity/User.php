<?php

namespace App\Entity;

class User
{
    public $wallet;

    public function getCurrentUser(): User
    {
        return $this;
    }

    public function update(array $parameters): self
    {
        $this->wallet = $parameters['wallet'] ?? $this->wallet;
        return $this;
    }
}