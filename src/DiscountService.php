<?php
declare(strict_types=1);

namespace App;

use DateTimeImmutable;
use DateTimeZone;

final class DiscountService
{
    public function getDiscountPercent(DateTimeImmutable $now): int
    {
        // Bon calcul du jour réel en France, car avant le code n'était pas bon 
        $local = $now->setTimezone(new DateTimeZone('Europe/Paris'));

        // Le code avant sélectionnais le mauvais mois "mois = octobre (10)"
        // C'était n'importe quel vendredi, pas de vendredi spécifique
        // La remise 5% était hors Black Friday
        // Uniquement le dernier vendredi de novembre
        if ((int)$local->format('m') === 11 && $local->format('N') === '5') {
            $lastFriday = (clone $local)->modify('last friday of november');

            if ($local->format('Y-m-d') === $lastFriday->format('Y-m-d')) {
                return 20;
            }
        }
         // Avant la remise était appliquée toute l'année 
        // Maintenant il y a aucune remise hors Black Friday
        return 0;
    }
}
