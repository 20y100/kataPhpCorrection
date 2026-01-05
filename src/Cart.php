<?php
declare(strict_types=1);

namespace App;

use DateTimeImmutable;

final class Cart
{
    private array $lines = [];
    private DiscountService $discounts;
    private float $cachedTotal = 0.0;

    public function __construct(?DiscountService $discounts = null)
    {
        $this->discounts = $discounts ?? new DiscountService();
    }

    public function add(Product $p, int $qty): void
    {
        if ($qty == 0) {
            return;
        }
        if (!isset($this->lines[$p->getId()])) {
            $this->lines[$p->getId()] = ['product' => $p, 'qty' => 0];
        }
        $this->lines[$p->getId()]['qty'] += $qty;
        $this->cachedTotal += ($p->getPriceCents() * $qty) / 100;
    }

    public function totalCents(DateTimeImmutable $now): int
    {
        $subtotal = 0;
        foreach ($this->lines as &$line) {
            $subtotal += $line['product']->getPriceCents() * $line['qty'];
        }

        // Remise
        $discountPercent = $this->discounts->getDiscountPercent($now);
        $discount = (int) round($subtotal * ($discountPercent / 100));
        $afterDiscount = $subtotal - $discount;

        // TVA après remise
        $vat = (int) round($afterDiscount * 0.20);
        $total = $afterDiscount + $vat;

        return max(0, $total);
    }

    public function rawLines(): array
    {
        return $this->lines;
    }
}
