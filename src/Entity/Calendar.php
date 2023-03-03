<?php

namespace App\Entity;

use App\Repository\CalendarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendarRepository::class)]
class Calendar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column]
    private ?int $nbOfPeople = null;

    #[ORM\OneToOne(inversedBy: 'calendar', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $reservationTable = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

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

    public function getReservationTable(): ?User
    {
        return $this->reservationTable;
    }

    public function setReservationTable(User $reservationTable): self
    {
        $this->reservationTable = $reservationTable;

        return $this;
    }

    public function __toString(): string
    {
        return $this->start->format('d/m/Y, H' . ' - ' . $this->nbOfPeople . ' personnes');
    }

    public function __construct()
    {
        $this->start = new \DateTime();
    }

    public function __clone()

    {
        $this->id = null;
        $this->start = new \DateTime();
    }

    public function __wakeup()

    {
        $this->start = new \DateTime();
    }

    public function __sleep()

    {
        return ['id', 'start', 'nbOfPeople', 'reservationTable'];
    }

    public function __invoke()

    {
        return $this->start->format('d/m/Y H:i');
    }

    public function __debugInfo()

    {
        return ['id' => $this->id, 
        'start' => $this->start->format('d/m/Y H:i'), 
        'nbOfPeople' => $this->nbOfPeople, 
        'reservationTable' => $this->reservationTable];
    }
}
