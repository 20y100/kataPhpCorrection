# Cart Pricing Kata

## Mission

Corriger le code pour que tous les tests passent.

### Règles métier

- Prix en centimes (int)
- TVA 20% après remise
- Remise 20% le Black Friday (dernier vendredi de novembre)
- Quantités et IDs valides
- Total TTC non négatif

**Vérifiez que chaque règle est testée correctement.**

### Commandes
```bash
composer install
vendor/bin/phpunit
```

### Livrables
- Repo GitHub avec tout le code
- README résumant les actions menaient
- Tests exécutables
- CI (en bonus)


# Cart Pricing Kata - Correction Vyncent LUCHEZ.

## Problèmes identifiés

- **Prix en float** dans `Product.php` → devait être en **centimes (int)**.  
- **Ordre TVA / remise incorrect** dans `Cart::totalCents()`.  
- **Black Friday mal géré** dans `DiscountService` : mauvais mois, remise appliquée hors période, tous les vendredis pris en compte.  
- **Validation absente** : ID vide, prix négatif, quantité nulle ou négative étaient acceptés.  
- **Bug critique** dans `equals()` : utilisation de `=` au lieu de `===`.

---

## Corrections apportées

- Gestion correcte des **prix en centimes**.  
- Validation stricte des **entrées métier** (ID, prix, quantité).  
- Application correcte : **remise puis TVA**.  
- Black Friday correctement calculé : **dernier vendredi de novembre**.  
- Suppression des remises hors période.  
- Totaux sécurisés pour être **non négatifs**.  
- Bug `equals()` corrigé (`=` → `===`).  
