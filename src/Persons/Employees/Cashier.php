<?php

declare(strict_types=1);

namespace Persons\Employees;

use DateTime;
use FoodOrders\FoodOrder;
use Restaurants\Restaurant;
use Invoices\Invoice;

final class Cashier extends Employee
{
    public function generateOrder(array $categories, Restaurant $restaurant): FoodOrder
    {
        $items = [];
        foreach ($categories as $category) {
            // メニューからカテゴリに合うものを探す
            foreach ($restaurant->getMenu() as $item) {
                $className = (new \ReflectionClass($item))->getShortName();
                if ($className === $category) {
                    $items[] = $item;
                    break; // 一つ見つけたら次のカテゴリへ 
                }
            }

        }
        return new FoodOrder($items, new \DateTime());
    }

    public function generateInvoice(FoodOrder $order): Invoice
    {
        echo "{$this->getName()} is generating an invoice.\n";
        $total = array_reduce($order->getItems(), fn($sum, $item) => $sum + $item->getPrice(), 0.0);
        $estimateTime = count($order->getItems()) * 5 ;
        $invoice = new Invoice($total, new DateTime(), $estimateTime);

        return $invoice;
    }
}
