<?php

namespace App\Entity;

use App\Repository\StaffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 14)]
    private ?string $phone_number = null;

    #[ORM\Column(length: 255)]
    private ?string $situation_family = null;

    #[ORM\Column]
    private ?int $civility = null;

    #[ORM\Column(length: 255)]
    private ?string $nationality = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $code_postal = null;

    #[ORM\Column]
    private ?int $number_child = null;

    #[ORM\OneToMany(mappedBy: 'staff', targetEntity: Departement::class, orphanRemoval: true)]
    private Collection $departement;

    #[ORM\OneToMany(mappedBy: 'staff', targetEntity: Responsable::class, orphanRemoval: true)]
    private Collection $responsable;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column]
    private ?float $salary_base = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_begin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_end = null;

    #[ORM\Column]
    private ?int $hours_per_week = null;

    #[ORM\Column]
    private ?int $day_per_week = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $horary = null;

    #[ORM\ManyToOne(inversedBy: 'staff')]
    private ?Contrat $contratType = null;

    public function __construct()
    {
        $this->departement = new ArrayCollection();
        $this->responsable = new ArrayCollection();
    }

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

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getSituationFamily(): ?string
    {
        return $this->situation_family;
    }

    public function setSituationFamily(string $situation_family): static
    {
        $this->situation_family = $situation_family;

        return $this;
    }

    public function getCivility(): ?int
    {
        return $this->civility;
    }

    public function setCivility(int $civility): static
    {
        $this->civility = $civility;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getNumberChild(): ?int
    {
        return $this->number_child;
    }

    public function setNumberChild(int $number_child): static
    {
        $this->number_child = $number_child;

        return $this;
    }

    /**
     * @return Collection<int, Departement>
     */
    public function getDepartement(): Collection
    {
        return $this->departement;
    }

    public function addDepartement(Departement $departement): static
    {
        if (!$this->departement->contains($departement)) {
            $this->departement->add($departement);
            $departement->setStaff($this);
        }

        return $this;
    }

    public function removeDepartement(Departement $departement): static
    {
        if ($this->departement->removeElement($departement)) {
            // set the owning side to null (unless already changed)
            if ($departement->getStaff() === $this) {
                $departement->setStaff(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Responsable>
     */
    public function getResponsable(): Collection
    {
        return $this->responsable;
    }

    public function addResponsable(Responsable $responsable): static
    {
        if (!$this->responsable->contains($responsable)) {
            $this->responsable->add($responsable);
            $responsable->setStaff($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): static
    {
        if ($this->responsable->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getStaff() === $this) {
                $responsable->setStaff(null);
            }
        }

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getSalaryBase(): ?float
    {
        return $this->salary_base;
    }

    public function setSalaryBase(float $salary_base): static
    {
        $this->salary_base = $salary_base;

        return $this;
    }



    public function getDateBegin(): ?\DateTimeInterface
    {
        return $this->date_begin;
    }

    public function setDateBegin(\DateTimeInterface $date_begin): static
    {
        $this->date_begin = $date_begin;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(?\DateTimeInterface $date_end): static
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getHoursPerWeek(): ?int
    {
        return $this->hours_per_week;
    }

    public function setHoursPerWeek(int $hours_per_week): static
    {
        $this->hours_per_week = $hours_per_week;

        return $this;
    }

    public function getDayPerWeek(): ?int
    {
        return $this->day_per_week;
    }

    public function setDayPerWeek(int $day_per_week): static
    {
        $this->day_per_week = $day_per_week;

        return $this;
    }

    public function getHorary(): ?\DateTimeInterface
    {
        return $this->horary;
    }

    public function setHorary(?\DateTimeInterface $horary): static
    {
        $this->horary = $horary;

        return $this;
    }

    public function getContratType(): ?Contrat
    {
        return $this->contratType;
    }

    public function setContratType(?Contrat $contratType): static
    {
        $this->contratType = $contratType;

        return $this;
    }
}
