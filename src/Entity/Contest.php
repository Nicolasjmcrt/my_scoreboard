<?php

namespace App\Entity;

use App\Repository\ContestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContestRepository::class)]
class Contest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'contest', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'Please select a game.')]
    private ?Game $game = null;

    #[ORM\Column(nullable: true)]
    private ?int $winner_id = null;

    #[ORM\OneToMany(mappedBy: 'contest', targetEntity: PlayerContest::class, orphanRemoval: true)]
    private Collection $playerContests;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message: 'Please select a start date.')]
    private ?\DateTimeInterface $start_date = null;

    public function __construct()
    {
        $this->playerContests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getWinnerId(): ?int
    {
        return $this->winner_id;
    }

    public function setWinnerId(?int $winner_id): self
    {
        $this->winner_id = $winner_id;

        return $this;
    }

    /**
     * @return Collection<int, PlayerContest>
     */
    public function getPlayerContests(): Collection
    {
        return $this->playerContests;
    }

    public function addPlayerContest(PlayerContest $playerContest): self
    {
        if (!$this->playerContests->contains($playerContest)) {
            $this->playerContests->add($playerContest);
            $playerContest->setContest($this);
        }

        return $this;
    }

    public function removePlayerContest(PlayerContest $playerContest): self
    {
        if ($this->playerContests->removeElement($playerContest)) {
            // set the owning side to null (unless already changed)
            if ($playerContest->getContest() === $this) {
                $playerContest->setContest(null);
            }
        }

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }
}
