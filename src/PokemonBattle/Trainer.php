<?php

namespace ValouuR\PokemonBattle\Model;

/**
 * Class Trainer
 * @package ValouuR\PokemonBattle\Model
 *
 * @Entity
 * @Table(name="trainer")
 */
class Trainer implements TrainerInterface {
    /**
     * @var int
     *
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="username", type="string", length=20)
     */
    private $username;

    /**
     * @var string
     *
     * @Column(name="password", type="string", length=20)
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
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @throws \Exception
     * @return TrainerInterface
     */
    public function setUsername($username)
    {
        if(is_string($username)) {
            $this->username = $username;
        } else {
            throw new \Exception('Username must be a string');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @throws \Exception
     * @return TrainerInterface
     */
    public function setPassword($password)
    {
        if(is_string($password)) {
            $this->password = $password;
        } else {
            throw new \Exception('Password must be a string');
        }

        return $this;
    }


} 