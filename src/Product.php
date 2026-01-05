<?php
declare(strict_types=1);

namespace App;

final class Product
{
    private string $id;
    private ?string $name = null;
    private int $priceCents = 0;

    public function __construct(string $id, string $name, int $priceCents) // On met que int pour le $priceCents
    {
        // InvalidArgumentException pour l'ID obligatoire
        if (trim($id) === '') {
            throw new \InvalidArgumentException('ID invalide');
        }

        // InvalidArgumentException pour le prix >= 0 obligatoire
        if ($priceCents < 0) {
            throw new \InvalidArgumentException('Prix négatif interdit');
        }

        $this->id = $id;
        $this->name = trim($name);

        // Pour avoir que des centimes
        $this->priceCents = $priceCents;
    }

    public function getPriceCents(): int // Changement de float a int
    {
        return $this->priceCents;
    }

    public function setName(string $name): string
    {
        $this->name = trim($name);
        return $this->name;
    }

    public function equals(Product $other): bool
    {
        return $this->id === $other->id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
