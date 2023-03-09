<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateStart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $timeStart = null;

    #[ORM\Column]
    private ?int $nbOfPeople = null;

    #[ORM\OneToOne(inversedBy: 'reservation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

  

    public function getNbOfPeople(): ?int
    {
        return $this->nbOfPeople;
    }

    public function setNbOfPeople(int $nbOfPeople): self
    {
        $this->nbOfPeople = $nbOfPeople;

        return $this;
    }

    public function getName(): ?User
    {
        return $this->name;
    }

    public function setName(User $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of dateStart
     *
     * @return ?\DateTimeInterface
     */
    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    /**
     * Set the value of dateStart
     *
     * @param ?\DateTimeInterface $dateStart
     *
     * @return self
     */
    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get the value of timeStart
     *
     * @return ?\DateTimeInterface
     */
    public function getTimeStart(): ?\DateTimeInterface
    {
        return $this->timeStart;
    }

    /**
     * Set the value of timeStart
     *
     * @param ?\DateTimeInterface $timeStart
     *
     * @return self
     */
    public function setTimeStart(?\DateTimeInterface $timeStart): self
    {
        $this->timeStart = $timeStart;

        return $this;
    }
}
