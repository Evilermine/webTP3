<?php

use Doctrine\ORM\Annotation as ORM;

/**
 * @Entity @Table(name="products")
 **/
class Product {

    /** @Id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @Column @Column(type="string")  **/
    private $name;

    /** @Column @Column(type="string") **/
    private $description;

    /** @Column @Column(type="integer") **/
    private $price;

    /** @Column @Column(type="string") **/
    private $image;

    public function getName(): string{
        return $this->name;
    }

    public function getPrice(): double{
        return $this->price;
    }

    public function setPrice(double $price): void{
        $this->price = $price;
    }

    public function getImage(): string{
        return $this->image;
    }

    public function setImage(string $image): void{
        $this->image = $image;
    }

    public function getDescription(): string{
        return $this->description;
    }

    public function setDescription(string $description): void{
        $this->description = $description;
    }
}