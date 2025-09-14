<?php

declare(strict_types=1);

namespace Persons\Employees;

use FoodOrders\FoodOrder;

final class Chef extends Employee
{
    public function prepareFood(FoodOrder $order): string
    {
        // 
        $output = "";
        $items = $order->getItems();
        foreach ($items as $item) {
            $output .= "{$this->getName()} was cooking {$item->getName()}.\n";
        }

        // 調理時間の計算
        $minutes = count($items) * 5; // 仮に1品あたり5分とする
        $output .= "{$this->getName()} took {$minutes} minutes to prepare the order.\n";
        return $output;
    }
}
