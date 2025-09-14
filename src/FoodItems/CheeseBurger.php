<?php
declare(strict_types=1);

namespace FoodItems;

final class CheeseBurger extends FoodItem
{
    public static function getCategory(): string { return 'burger'; }
}
