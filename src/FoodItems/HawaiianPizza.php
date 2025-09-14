<?php
declare(strict_types=1);

namespace FoodItems;

final class HawaiianPizza extends FoodItem
{
    public static function getCategory(): string { return 'pizza'; }
}
