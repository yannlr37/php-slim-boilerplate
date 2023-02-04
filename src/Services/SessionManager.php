<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-02-04
 * Time: 09:58
 */

namespace Sheepdev\Services;


use Sheepdev\Repository\UserRepository;

class SessionManager
{
    private const SESSION_USER_KEY = 'users';
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
        $userCookie = $_COOKIE[self::COOKIE_USER_KEY] ?? null;

        // if not exist, user must authenticate
        if (is_null($userCookie)) {
            return false;
        }

        // else, store user infos in session
        setcookie(self::COOKIE_USER_KEY, uniqid(), time() + 3600);
        dd($_COOKIE);

        $currentUser = $_SESSION[self::SESSION_USER_KEY] ?? [];
        if (empty($currentUsers)) {
            return false;
        }
        return true;
    }

}