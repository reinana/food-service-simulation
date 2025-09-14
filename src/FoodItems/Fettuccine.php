<?php
declare(strict_types=1);

namespace FoodItems;

final class Fettuccine extends FoodItem
{
    public static function getCategory(): string { return 'pasta'; }
}
