<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BudgetGoalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BudgetGoalRepository::class)]
#[ApiResource]
class BudgetGoal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $targetAmount = null;

    #[ORM\Column]
    private ?float $currentAmount = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $targetDate = null;

    /**
     * @var Collection<int, Transaction>
     */
    #[ORM\OneToMany(targetEntity: Transaction::class, mappedBy: 'budgetGoal', orphanRemoval: true)]
    private Collection $transactions;

    #[ORM\ManyToOne(inversedBy: 'budgetGoals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTargetAmount(): ?float
    {
        return $this->targetAmount;
    }

    public function setTargetAmount(float $targetAmount): static
    {
        $this->targetAmount = $targetAmount;

        return $this;
    }

    public function getCurrentAmount(): ?float
    {
        return $this->currentAmount;
    }

    public function setCurrentAmount(float $currentAmount): static
    {
        $this->currentAmount = $currentAmount;

        return $this;
    }

    public function getTargetDate(): ?\DateTimeInterface
    {
        return $this->targetDate;
    }

    public function setTargetDate(?\DateTimeInterface $targetDate): static
    {
        $this->targetDate = $targetDate;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): static
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
            $transaction->setBudgetGoal($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): static
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getBudgetGoal() === $this) {
                $transaction->setBudgetGoal(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
