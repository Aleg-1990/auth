<?php

namespace ActiveRecord;

use Db;

class User
{
    const TABLE_NAME = 'users';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    protected function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function save()
    {
        $db = Db::getConnection();
        if(null === $this->getId()) {
            return $db->prepare('INSERT INTO '.self::TABLE_NAME.' VALUES (NULL,?,?,?)')->execute([
                $this->getLogin(),
                $this->getEmail(),
                $this->getPassword()
            ]);
        } else {
            return $db->prepare('UPDATE '.self::TABLE_NAME.' SET login=?, email=?, password=?')->execute([
                $this->getLogin(),
                $this->getEmail(),
                $this->getPassword()
            ]);
        }
    }

    /**
     * @param $username
     *
     * @return User
     */
    public static function loadByUsername($username) {
        $user = new static();
        $sth = Db::getConnection()->prepare('SELECT id, login, email, password FROM '.self::TABLE_NAME.' WHERE login=?');
        $sth->execute([$username]);

        $result = $sth->fetch();
        $user->setId($result['id']);
        $user->setLogin($result['login']);
        $user->setEmail($result['email']);
        $user->setPassword($result['password']);
        return $user;
    }

    public static function hashPassword($password)
    {
        return md5($password);
    }
}