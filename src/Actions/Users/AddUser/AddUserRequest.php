<?php

namespace Sheepdev\Actions\Users\AddUser;

class AddUserRequest
{
    /** @var string */
    public $firstname = '';
    /** @var string */
    public $lastname = '';
    /** @var string */
    public $email = '';
    /** @var string */
    public $password = '';
    /** @var array */
    public $roles = [];
}