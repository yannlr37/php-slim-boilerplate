<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-02-04
 * Time: 10:22
 */

namespace Sheepdev\Auth;


use Sheepdev\Entity\User;
use Sheepdev\Repository\UserRepository;

class AuthManager
{
    private const COOKIE_USER_KEY = 'sheepdev_cookie_user_auth';

    /** @var UserRepository  */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function isUserAuthenticated(): bool
    {
        // get cookie on user's PC
        $usersessionToken = $_COOKIE[self::COOKIE_USER_KEY] ?? null;

        // if not exist, user must authenticate
        if (is_null($usersessionToken)) {
            return false;
        }

        // check if cookie session token equals the one from DB
        // if not : cookie should have expired, user must log in again
        $currentUser = $this->getCurrentLoginInUser();
        if (is_null($currentUser)) {
            unset($_COOKIE[self::COOKIE_USER_KEY]);
            return false;
        }

        return true;
    }

    /**
     * @return User|null
     */
    public function getCurrentLoginInUser()
    {
        return $this->userRepository->getUserBySessionToken($_COOKIE[self::COOKIE_USER_KEY]);
    }

    public function storeUserAuthentication(int $userId)
    {
        $userSessionToken = uniqid();
        $this->userRepository->setSessionToken($userId, $userSessionToken);
        setcookie(self::COOKIE_USER_KEY, $userSessionToken, time() + 86400);
    }


}