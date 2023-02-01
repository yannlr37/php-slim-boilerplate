<?php

namespace Sheepdev\Actions\Users\AddUser;

class AddUserRequest
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public array $roles = [];
}