<?php

namespace Sheepdev\Actions\Users\AddUser;

use Sheepdev\Actions\ActionResponse;
use Sheepdev\Auth\PasswordCryptService;
use Sheepdev\Entity\User;
use Sheepdev\Repository\UserRepository;

class AddUserAction
{
    /** @var UserRepository */
    private $repository;
    /** @var PasswordCryptService */
    private $cryptService;

    public function __construct(
        UserRepository $repository,
        PasswordCryptService $cryptService
    ) {
        $this->repository = $repository;
        $this->cryptService = $cryptService;
    }

    public function execute(AddUserRequest $input): ActionResponse
    {
        $response = new ActionResponse();

        if ($input->firstname == '') {
            $response->errors[] = "Firstname must not be empty";
        }
        if ($input->lastname == '') {
            $response->errors[] = "Lastname must not be empty";
        }
        if ($input->email == '') {
            $response->errors[] = "Email must not be empty";
        }
        if ($input->password == '') {
            $response->errors[] = "Password must not be empty";
        }

        if (!empty($response->errors)) {
            $response->success = false;
            return $response;
        }

        $user = new User();
        $user->setFirstname($input->firstname);
        $user->setLastname($input->lastname);
        $user->setEmail($input->email);
        $user->setPassword($this->cryptService->encryptPassword($input->password));
        $user->setRolesArray($input->roles);
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());

        if (!$this->repository->add($user)) {
            $response->success = false;
            $response->errors[] = "Cannot save User data";
        }

        return $response;
    }
}