<?php

namespace App\Entity;

use App\Repository\StaffRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaffRepository::class)]
class Staff
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birth_ = null;

    #[ORM\Column(length: 255)]
    private ?string $number_cin = null;

    #[ORM\Column(length: 255)]
    private ?string $number_matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_exact = null;

    #[ORM\Column(length: 255)]
    private ?string $work_post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth_;
    }

    public function setBirth(\DateTimeInterface $birth_): static
    {
        $this->birth_ = $birth_;

        return $this;
    }

    public function getNumberCin(): ?string
    {
        return $this->number_cin;
    }

    public function setNumberCin(string $number_cin): static
    {
        $this->number_cin = $number_cin;

        return $this;
    }

    public function getNumberMatricule(): ?string
    {
        return $this->number_matricule;
    }

    public function setNumberMatricule(string $number_matricule): static
    {
        $this->number_matricule = $number_matricule;

        return $this;
    }

    public function getAdresseExact(): ?string
    {
        return $this->adresse_exact;
    }

    public function setAdresseExact(string $adresse_exact): static
    {
        $this->adresse_exact = $adresse_exact;

        return $this;
    }

    public function getWorkPost(): ?string
    {
        return $this->work_post;
    }

    public function setWorkPost(string $work_post): static
    {
        $this->work_post = $work_post;

        return $this;
    }
}
