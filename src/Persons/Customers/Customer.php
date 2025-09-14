<?php

declare(strict_types=1);

namespace Persons\Customers;

use Persons\Person;
use Invoices\Invoice;
use Restaurants\Restaurant;

class Customer extends Person
{

    private array $categories; // 興味のある食べ物のカテゴリ

    public function __construct(string $name, int $age, string $address, array $categories)
    {
        parent::__construct($name, $age, $address);
        $this->categories = $categories;
    }
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function interestedCategories(Restaurant $restaurant): array
    {
        // ① 欲しい料理名（マップのキー）を並べて表示
        $wantedDishNames = array_keys($this->categories);
        echo "{$this->getName()} wanted to eat " . implode(', ', $wantedDishNames) . "." . PHP_EOL;

        // レストランのメニューを取得
        $menu = $restaurant->getMenu();
        $menuNames = [];


        // メニューのクラス短縮名をキーにする
        foreach ($menu as $item) {
            $shortName = (new \ReflectionClass($item))->getShortName();
            $menuNames[$shortName] = true;
        }

        $interested = [];

        // Customer の interestedTastedMap をループ
        foreach ($this->categories as $dishName => $count) {
            if (isset($menuNames[$dishName])) {        // メニューに存在するか？
                for ($i = 0; $i < $count; $i++) {
                    $interested[] = $dishName;        // 値の数だけ追加
                }
            }
        }

        return $interested; // 文字列の配列
    }
    // 注文を出す
    public function order($restaurant): Invoice
    {
        $interested = $this->interestedCategories($restaurant);
        // 1) 注文したい料理と数量をまとめる
        $ordered = [];
        foreach ($restaurant->getMenu() as $item) {
            $shortName = (new \ReflectionClass($item))->getShortName();
            if (isset($this->categories[$shortName])) {
                $count = $this->categories[$shortName];
                if ($count > 0) {
                    $ordered[] = "{$shortName} × {$count}";
                }
            }
        }

        // 2) ログを出力（例: "Tom was looking at the menu, and ordered CheeseBurger × 2, Spaghetti × 1."）
        if (!empty($ordered)) {
            echo "{$this->getName()} was looking at the menu, and ordered " . implode(', ', $ordered) . "." . PHP_EOL;
        }
        return $restaurant->order($interested);
    }
}
