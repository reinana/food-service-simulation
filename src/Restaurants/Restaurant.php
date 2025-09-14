<?php 

namespace Restaurants;

use FoodItems\FoodItem;
use Invoices\Invoice;
use Persons\Employees\Cashier;
use Persons\Employees\Chef;

echo "Restaurant.php\n";
class Restaurant
{
    private string $name;
    /** @var FoodItem[] */
    private array $menu;
    /** @var Employee[] */
    private array $employees;

    /**
     * @param string $name
     * @param FoodItem[] $menu
     * @param Employee[] $employees
     */
    public function __construct(string $name, array $menu, array $employees)
    {
        $this->name = $name;
        $this->menu = $menu;
        $this->employees = $employees;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return FoodItem[]
     */
    public function getMenu(): array
    {
        return $this->menu;
    }

    /**
     * @return Employee[]
     */
    public function getEmployees(): array
    {
        return $this->employees;
    }

    /**
     * @param string[] $categories
     * @return Invoice
     */
    // Customerから呼ばれる
    public function order($categories): Invoice
    {
        // レジ係を選ぶ
        $cashier = null;
        foreach ($this->employees as $employee) {
            if ($employee instanceof Cashier) {
                $cashier = $employee;
                break;
            }
        }
        if ($cashier === null) {
            throw new \Exception("No cashier available");
        } 
        // CashierのgenerateOrder()を呼び出し、
        // 注文を受け付け、FoodOrderを作成
        $foodOrder = $cashier->generateOrder($categories, $this);
        // FoodOrderを受け取り、chefクラスのprepareFood()を呼び出す
        
        // シェフを探す
        $chef = null;
        foreach ($this->employees as $employee) {
            if ($employee instanceof Chef) {
                $chef = $employee;
                break;
            }
        }
        if ($chef === null) {
            throw new \Exception("No chef available");
        }
        // シェフに料理を準備させる messegeが表示される
        echo $chef->prepareFood($foodOrder);
        
        // Invoiceを作成
        $invoice = $cashier->generateInvoice($foodOrder);  

        
        return $invoice;
    }
}
?>