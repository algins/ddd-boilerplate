<?php

namespace App\Blog\Application\User\ViewUsers;

use App\Blog\Domain\Model\User\User;

class ViewUsersResponse
{
    private string $id;
    private string $firstName;
    private string $lastName;

    public function __construct(User $user)
    {
        $this->id = $user->getId()->getValue();
        $this->firstName = $user->getFirstName();
        $this->lastName = $user->getLastName();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
