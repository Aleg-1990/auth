<?php

namespace Authentication;


use ActiveRecord\User;

class Authentication
{
    /**
     * @param string $username
     * @param string $password
     *
     * @return bool Whether login is successful.
     */
    public function login($username, $password)
    {
        $user = $this->getUserByCredentials($username, $password);
        if(is_object($user)) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function register($name, $email, $password)
    {
        return $this->createUser($name, $email, $password);
    }

    /**
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['user']);
    }

    /**
     * @return bool Whether user is logged in.
     */
    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    /**
     * @return User|null
     */
    public function getCurrentUser()
    {
        return $_SESSION['user'];
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return bool Whether user has been created.
     */
    private function createUser($name, $email, $password)
    {
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return User
     */
    private function getUserByCredentials($username, $password)
    {
        $user = User::loadByUsername($username);
        if(User::hashPassword($password) === $user->getPassword()) {
            return $user;
        }

    }
}