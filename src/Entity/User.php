<?php

namespace Sheepdev\Entity;

use DateTime;
use Sheepdev\Auth\PasswordCryptService;
use Sheepdev\DBAL\Entity;

class User extends Entity
{
    /** @var string */
    private $firstname;
    /** @var string */
    private $lastname;
    /** @var string */
    private $email;
    /** @var string */
    private $password;
    /** @var string */
    private $roles;
    /** @var DateTime */
    private $created_at;
    /** @var DateTime */
    private $updated_at;

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getRoles(): array
    {
        return $this->getCleanedRolesArray();
    }

    public function setRoles(string $roles): void
    {
        $this->roles = $roles;
    }

    public function setRolesArray(array $roles): void
    {
        array_walk($roles, function (&$item) {
            return trim($item);
        });
        $this->roles = implode(',', $roles);
    }

    public function addRole(string $role): void
    {
        $role = trim($role);
        $roles = $this->getCleanedRolesArray();
        if (!in_array($role, $roles)) {
            $roles[] = trim($role);
        }
        $this->roles = implode(',', $roles);
    }

    public function removeRole(string $role): void
    {
        $role = trim($role);
        $roles = $this->getCleanedRolesArray();
        if (in_array($role, $roles)) {
            $roles = array_filter($roles, function($item) use ($role) {
               return  $item !== $role;
            });
            $this->roles = implode(',', $roles);
        }
    }

    private function getCleanedRolesArray(): array
    {
        $roles = explode(',', $this->roles);
        array_walk($roles, function (&$item) {
            return trim($item);
        });
        return $roles;
    }
}