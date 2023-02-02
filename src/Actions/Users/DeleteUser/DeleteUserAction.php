<?php

namespace Sheepdev\Actions\Users\DeleteUser;

use Sheepdev\Actions\ActionResponse;
use Sheepdev\Repository\UserRepository;

class DeleteUserAction
{
    private UserRepository $repository;

    public function __construct(
        UserRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function execute(DeleteUserRequest $input): ActionResponse
    {
        $response = new ActionResponse();

        if ($input->userId == 0) {
            $response->errors[] = "User id must be given";
        }

        if (!empty($response->errors)) {
            $response->success = false;
            return $response;
        }

        $user = $this->repository->getById($input->userId);
        if (is_null($user)) {
            $response->success = false;
            $response->errors[] = "User of id {$input->userId} does not exist";
            return $response;
        }

        if (!$this->repository->delete($input->userId)) {
            $response->success = false;
            $response->errors[] = "Cannot delete User #{$input->userId}";
        }

        return $response;
    }
}