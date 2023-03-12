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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEnd;

    #[ORM\Column]
    #[ASSERT\NotBlank(message: 'Veuillez renseigner une heure')]
    private ?string $timeStart = null;

    #[ORM\Column]
    #[ASSERT\NotBlank(message: 'Veuillez renseigner une heure')]
    #[ASSERT\GreaterThan(propertyPath: 'timeStart', 
    message: 'L\'heure de fin doit être supérieure à l\'heure de début')]
    private ?string $timeEnd = null;

    #[ORM\Column]
    private ?int $reservationTableId = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $reservationTable = null;

    #[ORM\Column]
    private ?int $nbOfPeople = null;

 
    public function __construct()
    {
        $this->dateStart = new \DateTime();
        $this->dateEnd = clone $this->dateStart;
    }

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
    $this->dateEnd = $dateStart; // Set dateEnd to same value as dateStart

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

     /**
     * Get the value of dateEnd
     *
     * @return ?\DateTimeInterface
     */
    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    /**
     * Set the value of dateEnd
     *
     * @param ?\DateTimeInterface $dateEnd
     *
     * @return self
     */
    public function setDateEnd(?\DateTimeInterface $dateEnd): self
{
    if ($dateEnd < $this->dateStart) {
        throw new \InvalidArgumentException('La date de fin doit être supérieure ou égale à la date de début.');
    }
    $this->dateEnd = $dateEnd;

    return $this;
}

     /**
     * Get the value of timeEnd
     *
     * @return ?string
     */
    public function getTimeEnd(): ?string
    {
        return $this->timeEnd;
    }

    /**
     * Set the value of timeEnd
     *
     * @param ?string $timeEnd
     *
     * @return self
     */
    public function setTimeEnd(?string $timeEnd): self
    {
        $this->timeEnd = $timeEnd;

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
    public function getReservationTable(): ?Users
    {
        return $this->reservationTable;
    }

    public function setReservationTable(Users $reservationTable): self
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
