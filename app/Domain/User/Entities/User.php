<?php

namespace App\Domain\User\Entities;

use InvalidArgumentException;

class User
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $document;
    private string $passwordHash;
    private ?int $id;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $document,
        string $passwordHash,
        ?int $id = null
    ){
        $firstName = trim($firstName);
        $lastName = trim($lastName);
        $email = trim($email);
        $document = trim($document);
        $passwordHash = trim($passwordHash);

        if ($firstName === "")
        {
            throw new InvalidArgumentException('O nome do usuário é obrigatório');
        }

        if ($lastName === "")
        {
            throw new InvalidArgumentException('O sobrenome do usuário é obrigatório');
        }

        if ($email === "")
        {
            throw new InvalidArgumentException('O e-mail do usuário é obrigatório');
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new InvalidArgumentException('O e-mail do usuário é inválido.');
        }

        if ($document === "")
        {
            throw new InvalidArgumentException('O CPF do usuário é obrigatório');
        }

        if ($passwordHash === "")
        {
            throw new InvalidArgumentException('A senha do usuário é obrigatório');
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->document = $document;
        $this->passwordHash = $passwordHash;
        $this->id  = $id ;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
