<?php

namespace App\Entity;

use App\Repository\UserToDepotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserToDepotRepository::class)]
class UserToDepot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'UserToDepot')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: Depots::class, inversedBy: 'UserToDepot')]
    #[ORM\JoinColumn(nullable: false)]
    private $depot;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDepot(): ?Depots
    {
        return $this->depot;
    }

    public function setDepot(?Depots $depot): self
    {
        $this->depot = $depot;

        return $this;
    }
}
