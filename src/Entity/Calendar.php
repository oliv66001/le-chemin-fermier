<?php

namespace App\Entity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CalendarRepository;
use Symfony\Component\Validator\Constraints as ASSERT;

#[ORM\Entity(repositoryClass: CalendarRepository::class)]
class Calendar
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateStart = null;

    #[ORM\Column]
    #[ASSERT\NotBlank(message: 'Veuillez renseigner une heure')]
    private ?string $timeStart = null;

    #[ORM\Column]
    private ?int $reservationTableId = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
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

    public function getTimeStart(): ?string
    {
        return $this->timeStart;
    }

    public function setTimeStart(string $timeStart): self
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    public function getReservationTableId(): ?int
    {
        return $this->reservationTableId;
    }

    public function setReservationTableId(int $reservationTableId): self
    {
        $this->reservationTableId = $reservationTableId;

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
