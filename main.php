<?php
declare(strict_types=1);

/**
 * シンプルPSR-4風オートローダ：src/ を名前空間のルートにする
 */
spl_autoload_register(function (string $class): void {
    $baseDir = __DIR__ . '/src/';
    $path = $baseDir . str_replace('\\', '/', $class) . '.php';
    if (is_file($path)) require_once $path;
});
echo "main\n";
// ===== ここからサンプルシナリオ =====
use FoodItems\CheeseBurger;
use FoodItems\Fettuccine;
use FoodItems\HawaiianPizza;
use FoodItems\Spaghetti;

use Persons\Employees\Cashier;
use Persons\Employees\Chef;
use Persons\Customers\Customer;

use Restaurants\Restaurant;

// メニュー name, description, price
$menu = [
    new CheeseBurger('Cheese Burger', 'Beef + cheese', 8.5),
    new Fettuccine('Fettuccine', 'Cream sauce', 12.0),
    new HawaiianPizza('Hawaiian Pizza', 'Pineapple + ham', 14.0),
    new Spaghetti('Spaghetti', 'Tomato base', 10.0),
];

// 従業員 name, age, address, id, salary
$employees = [
    new Chef('Invah', 32, 'Tokyo', 1001, 3500.0),
    new Cashier('Nadia', 28, 'Tokyo', 2001, 3000.0),
];

// レストラン name, menu, employees
$saizeriya = new Restaurant('saizeriya', $menu, $employees);

// 顧客の興味カテゴリとそれに対応する味のマップ
$interestedTastedMap = [
    'Margherita' => 1,
    'CheeseBurger' => 2,
    'Spaghetti' => 1
];

// 客 name, age, address, categories
$tom = new Customer('Tom', 23, 'Chiyoda', $interestedTastedMap);

// 顧客の興味カテゴリとそれに対応する料理マップ
$interestedTastedMapAnna = [
    'HawaiianPizza' => 1,
    'Fettuccine'    => 2
];

// 顧客 name, age, address, id, balance
$anna = new Customer('Anna', 28, 'Shinjuku', $interestedTastedMapAnna);

// 注文作成
$invoice1 = $tom->order($saizeriya);
$invoice1->printeInvoice();

$invoice2 = $anna->order($saizeriya);
$invoice2->printeInvoice();


