<?php

use Doctrine\ORM\Annotation as ORM;

/** 
 * @Entity @Table(name="users")
 **/
class User{
    /** @Id  @Column(type="integer") @GeneratedValue**/
    private $id;

    /** @Column @Column(type="string") */
    private $firstname;

    /** @Column @Column(type="string") */
    private $lastname;

    /** @Column @Column(type="string") */
    private $username;

    /** @Column @Column(type="string") */
    private $passwordHash;

    /** @Column @Column(type="string") */
    private $email;

    /** @Column @Column(type="string") */
    private $address;

    /** @Column @Column(type="string") */
    private $city;

    /** @Column @Column(type="string") */
    private $country;

    public function getFirstname(): string{
        return $this->firstname;
    }
}