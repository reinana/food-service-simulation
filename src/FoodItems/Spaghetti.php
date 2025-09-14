<?php
declare(strict_types=1);

namespace FoodItems;

final class Spaghetti extends FoodItem
{
    public static function getCategory(): string { return 'pasta'; }
}
