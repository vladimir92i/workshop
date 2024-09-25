<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

use App\Repository\EventsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventsRepository::class)]
class Events
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("event.index")]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    #[Groups("event.index")]
    private ?bool $validation = null;
    
    #[ORM\ManyToOne]
    private ?Users $control_id = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("event.index")]
    private ?Users $creator_id = null;

    #[ORM\Column(nullable: true)]
    #[Groups("event.index")]
    private ?int $max_capacity = null;

    #[ORM\Column]
    #[Groups("event.index")]
    private ?\DateTimeImmutable $start_at = null;

    #[ORM\Column]
    #[Groups("event.index")]
    private ?\DateTimeImmutable $end_at = null;

    #[ORM\Column]
    #[Groups("event.index")]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * @var Collection<int, Reservations>
     */
    #[ORM\OneToMany(targetEntity: Reservations::class, mappedBy: 'event_id', orphanRemoval: true)]
    private Collection $reservations;
    
    #[Groups("room")]
    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Room $room_id = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(?bool $validation): static
    {
        $this->validation = $validation;

        return $this;
    }

    public function getControlId(): ?Users
    {
        return $this->control_id;
    }

    public function setControlId(?Users $control_id): static
    {
        $this->control_id = $control_id;

        return $this;
    }

    public function getCreatorId(): ?Users
    {
        return $this->creator_id;
    }

    public function setCreatorId(?Users $creator_id): static
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    public function getMaxCapacity(): ?int
    {
        return $this->max_capacity;
    }

    public function setMaxCapacity(?int $max_capacity): static
    {
        $this->max_capacity = $max_capacity;

        return $this;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->start_at;
    }

    public function setStartAt(\DateTimeImmutable $start_at): static
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->end_at;
    }

    public function setEndAt(\DateTimeImmutable $end_at): static
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Reservations>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservations $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setEventId($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getEventId() === $this) {
                $reservation->setEventId(null);
            }
        }

        return $this;
    }

    public function getRoomId(): ?Room
    {
        return $this->room_id;
    }

    public function setRoomId(?Room $room_id): static
    {
        $this->room_id = $room_id;

        return $this;
    }
}
