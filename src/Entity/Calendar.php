<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\MyTrait\SlugTrait;
use App\Repository\CalendarRepository;
use Symfony\Component\Validator\Constraints as ASSERT;

#[ORM\Entity(repositoryClass: CalendarRepository::class)]
class Calendar
{

    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateStart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[ASSERT\NotBlank(message: 'Veuillez renseigner une heure de début')]
    #[ASSERT\Regex(pattern: '/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/', message: 'Veuillez renseigner une heure valide')]
    private ?\DateTimeInterface $timeStart = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $reservationTable = null;

    #[ORM\Column]
    private ?int $nbOfPeople = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getTimeStart(): ?\DateTimeInterface
    {
        return $this->timeStart;
    }

    public function setTimeStart(\DateTimeInterface $timeStart): self
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    public function getReservationTable(): ?User
    {
        return $this->reservationTable;
    }

    public function setReservationTable(User $reservationTable): self
    {
        $this->reservationTable = $reservationTable;

        return $this;
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
}
