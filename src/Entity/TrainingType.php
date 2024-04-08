<?php

namespace App\Entity;

use App\Repository\TrainingTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingTypeRepository::class)]
class TrainingType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Training::class)]
    private Collection $trainings;

    //default value is 4E73DF
    #[ORM\Column(length: 255, nullable: false, options: ['default' => '4E73DF'])]
    private ?string $color = null;

    public function __construct()
    {
        $this->trainings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Training>
     */
    public function getTrainings(): Collection
    {
        //return trainings sorted by date
        $iterator = $this->trainings->getIterator();
        $iterator->uasort(function ($a, $b) {
            return $a->getCreatedAt() <=> $b->getCreatedAt();
        });

        return new ArrayCollection(iterator_to_array($iterator));
    }

    public function addTraining(Training $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings->add($training);
            $training->setType($this);
        }

        return $this;
    }

    public function removeTraining(Training $training): self
    {
        if ($this->trainings->removeElement($training) && $training->getType() === $this) {
            // set the owning side to null (unless already changed)
            $training->setType(null);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $color = ltrim($color, '#');
        $this->color = $color;

        return $this;
    }
}
