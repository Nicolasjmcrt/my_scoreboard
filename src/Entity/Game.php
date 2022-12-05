<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    #[Assert\NotBlank(message: 'Please enter a title.')]
    #[Assert\Length(max: 64, maxMessage: 'The title cannot be longer than {{ limit }} characters.')]
    private ?string $title = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Please enter a minimum number of players.')]
    #[Assert\Positive(message: 'The minimum number of players must be greater than 0.')]
    private ?int $min_players = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Please enter a maximum number of players.')]
    #[Assert\Positive(message: 'The maximum number of players must be greater than 0.')]
    private ?int $max_players = null;

    #[ORM\OneToOne(mappedBy: 'game', cascade: ['persist', 'remove'])]
    private ?Contest $contest = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getMinPlayers(): ?int
    {
        return $this->min_players;
    }

    public function setMinPlayers(int $min_players): self
    {
        $this->min_players = $min_players;

        return $this;
    }

    public function getMaxPlayers(): ?int
    {
        return $this->max_players;
    }

    public function setMaxPlayers(int $max_players): self
    {
        $this->max_players = $max_players;

        return $this;
    }

    public function getContest(): ?Contest
    {
        return $this->contest;
    }

    public function setContest(Contest $contest): self
    {
        // set the owning side of the relation if necessary
        if ($contest->getGame() !== $this) {
            $contest->setGame($this);
        }

        $this->contest = $contest;

        return $this;
    }
}
