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
        $userSessionToken = $_COOKIE[self::COOKIE_USER_KEY] ?? null;

        // if not exist, user must authenticate
        if (is_null($userSessionToken)) {
            return false;
        }

        // check if cookie session token equals the one from DB
        // if not : cookie should have expired, user must log in again
        $currentUser = $this->getCurrentLoggedInUser();
        if (empty($currentUser)) {
            unset($_COOKIE[self::COOKIE_USER_KEY]);
            return false;
        }

        return true;
    }

    public function getCurrentLoggedInUser(): array
    {
        $key = $_COOKIE[self::COOKIE_USER_KEY];
        if (!isset($_SESSION[$key])) {
            return [];
        }
        return json_decode($_SESSION[$key], true);
    }

    public function deleteCookie(): void
    {
        unset($_COOKIE[self::COOKIE_USER_KEY]);
    }

    public function storeUserAuthenticationToken(User $user)
    {
        $userSessionToken = uniqid();
        $this->userRepository->setSessionToken($user->getId(), $userSessionToken);
        setcookie(self::COOKIE_USER_KEY, $userSessionToken, time() + 86400);
        $user->setSessionToken($userSessionToken);
        $_SESSION[$userSessionToken] = json_encode($user->getFields());
    }

    public function authenticated(): bool
    {
        $user = $this->getCurrentLoggedInUser();
        return !empty($user);
    }

    public function firstname(): string
    {
        $user = $this->getCurrentLoggedInUser();
        return $user['firstname'];
    }

    public function lastname(): string
    {
        $user = $this->getCurrentLoggedInUser();
        return strtoupper($user['lastname']);
    }

}