<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Please enter an e-mail.')]
    #[Assert\Email(message: 'Please enter a valid e-mail.')]
    private ?string $email = null;

    #[ORM\Column(length: 64)]
    #[Assert\NotBlank(message: 'Please enter a nickname.')]
    #[Assert\Length(max: 64, maxMessage: 'The nickname cannot be longer than {{ limit }} characters.')]
    private ?string $nickname = null;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: PlayerContest::class, orphanRemoval: true)]
    private Collection $playerContests;

    public function __construct()
    {
        $this->playerContests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

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
            $playerContest->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerContest(PlayerContest $playerContest): self
    {
        if ($this->playerContests->removeElement($playerContest)) {
            // set the owning side to null (unless already changed)
            if ($playerContest->getPlayer() === $this) {
                $playerContest->setPlayer(null);
            }
        }

        return $this;
    }
}
