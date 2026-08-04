<?php

namespace App\Application\User\DTOs;

class CreateUserDTO
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $document;
    public string $passwordHash;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $document,
        string $passwordHash,
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->document = $document;
        $this->passwordHash = $passwordHash;
    }
}
