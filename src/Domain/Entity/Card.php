<?php


namespace App\Domain\Entity;


class Card
{
    /**
     * @var string
     */
    private $color;

    /**
     * @var int
     */
    private $number;

    public function __toString()
    {
        return $this->getCode();
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return sprintf('%s(%s)', $this->getNumber(), $this->getColor());
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }
}