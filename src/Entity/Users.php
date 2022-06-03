<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Roles::class, inversedBy: 'user')]
    #[ORM\JoinColumn(nullable: false)]
    private $role;

    #[ORM\Column(type: 'string', length: 255)]
    private $login;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserToDepot::class)]
    private $UserToDepot;

    public function __construct()
    {
        $this->UserToDepot = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(?Roles $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, UserToDepot>
     */
    public function getUserToDepot(): Collection
    {
        return $this->UserToDepot;
    }

    public function addUserToDepot(UserToDepot $userToDepot): self
    {
        if (!$this->UserToDepot->contains($userToDepot)) {
            $this->UserToDepot[] = $userToDepot;
            $userToDepot->setUser($this);
        }

        return $this;
    }

    public function removeUserToDepot(UserToDepot $userToDepot): self
    {
        if ($this->UserToDepot->removeElement($userToDepot)) {
            // set the owning side to null (unless already changed)
            if ($userToDepot->getUser() === $this) {
                $userToDepot->setUser(null);
            }
        }

        return $this;
    }
}
