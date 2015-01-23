<?php

namespace ValouuR\PokemonBattle\Model;

use \DateTime;

/**
 * Class Pokemon
 * @package ValouuR\PokemonBattle\Model
 *
 * @Entity
 * @Table(name="pokemon")
 */
class Pokemon implements PokemonInterface {
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
     * @Column(name="name", type="string", length=20)
     */
    private $name;

    /**
     * @var int
     *
     * @Column(name="hp", type="integer")
     */
    private $hp;

    /**
     * @var int
     *
     * @Column(name="type", type="smallint", length=1)
     */
    private $type;

    const TYPE_FIRE = 0;
    const TYPE_PLANT = 1;
    const TYPE_WATER = 2;

    /**
     * @var Trainer
     *
     * @OneToOne(targetEntity="Trainer")
     */
    private $trainer;

    /**
     * @Column(name="last_attack", type="datetime")
     */
    private $lastAttack;

    /**
     * @Column(name="last_resuscitate", type="datetime")
     */
    private $lastResuscitate;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @throws \Exception
     * @return Pokemon
     */
    public function setName($name)
    {
        if(is_string($name)) {
            $this->name = $name;
        } else {
            throw new \Exception('Name must be a string');
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getHP()
    {
        return $this->hp;
    }

    /**
     * @param int $hp
     *
     * @throws \Exception
     * @return Pokemon
     */
    public function setHP($hp)
    {
        if(is_int($hp) && $hp > 0) {
            $this->hp = $hp;
        } else {
            throw new \Exception('HP must be an integer and > 0');
        }

        return $this;
    }

    /**
     * @param int $hp
     *
     * @return int
     */
    public function addHP($hp)
    {

    }

    /**
     * @param int $hp
     *
     * @throws \Exception
     * @return int
     */
    public function removeHP($hp)
    {
        if(is_int($hp) && $hp > 0) {
            $this->hp = $this->hp - $hp;
        } else {
            throw new \Exception('HP must be an integer and > 0');
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @throws \Exception
     * @return Pokemon
     */
    public function setType($type)
    {
        if(true === in_array($type, [
                self::TYPE_FIRE,
                self::TYPE_PLANT,
                self::TYPE_WATER,
        ])) {
            $this->type = $type;
        } else {
            throw new \Exception('Type not valid');
        }

        return $this;
    }

    /**
     * @return Trainer
     */
    public function getTrainer()
    {
        return $this->trainer;
    }

    /**
     * @param Trainer $trainer
     *
     * @return Pokemon
     */
    public function setTrainer($trainer)
    {
        $this->trainer = $trainer;

        return $this;
    }

    /**
     * @return datetime
     */
    public function getLastAttack()
    {
        return $this->lastAttack;
    }

    /**
     * @param datetime $lastAttack
     * @throws \Exception
     * @return Pokemon
     */
    public function setLastAttack($lastAttack)
    {
        if($lastAttack instanceof DateTime) {
            $this->lastAttack = $lastAttack;
        } else {
            throw new \Exception('Last Attack must be a datetime');
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastResuscitate()
    {
        return $this->lastResuscitate;
    }

    /**
     * @param datetime $lastResuscitate
     * @throws \Exception
     * @return Pokemon
     */
    public function setLastResuscitate($lastResuscitate)
    {
        if($lastResuscitate instanceof DateTime) {
            $this->lastResuscitate = $lastResuscitate;
        } else {
            throw new \Exception('Last Resuscitate must be a datetime');
        }

        return $this;
    }
} 