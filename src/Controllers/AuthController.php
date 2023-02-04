<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-02-04
 * Time: 11:01
 */

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sheepdev\Auth\AuthManager;
use Sheepdev\Auth\PasswordCryptService;
use Sheepdev\Entity\User;
use Sheepdev\Repository\UserRepository;

class AuthController extends AbstractController
{
    /** @var UserRepository */
    private $userRepository;
    /** @var AuthManager */
    private $authManager;
    /** @var PasswordCryptService */
    private $passwordCryptService;

    public function __construct(
        UserRepository $userRepository,
        AuthManager $authManager,
        PasswordCryptService $passwordCryptService
    ) {
        $this->userRepository = $userRepository;
        $this->authManager = $authManager;
        $this->passwordCryptService = $passwordCryptService;
    }

    public function index(Response $response)
    {
        return $this->render($response, 'login');
    }

    public function login(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        /** @var User $user */
        $user = $this->userRepository->getUserByEmailAndPassword(
            $data['email'],
            $this->passwordCryptService->encryptPassword($data['password'])
        );
        if (is_null($user)) {
            // TODO: redirect to login page with error message
            redirect($response, $request, 'login.signin');
        }
        $this->authManager->storeUserAuthenticationToken($user);
        redirect($response, $request, 'home');
    }

    public function logout(Request $request, Response $response)
    {
        $user = $this->authManager->getCurrentLoggedInUser();
        if (
            !empty($user) &&
            !is_null($user['sessionToken']) &&
            isset($_SESSION[$user['sessionToken']])
        ) {
            unset($_SESSION[$user['sessionToken']]);
        }
        $this->authManager->deleteCookie();
        redirect($response, $request, 'login.signin');
    }
}