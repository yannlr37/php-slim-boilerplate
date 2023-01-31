<?php

namespace Sheepdev\Auth;

class PasswordCryptService
{
    public function encryptPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function checkPassword(string $password, string $cryptedPassword): bool
    {
        return $this->encryptPassword($password) === $cryptedPassword;
    }
}