<?php
declare(strict_types=1);

namespace Persons\Employees;

abstract class Employee extends \Persons\Person
{
    protected int $employeeId;
    protected float $salary;

    public function __construct(string $name, int $age, string $address, int $employeeId, float $salary)
    {
        parent::__construct($name, $age, $address);
        $this->employeeId = $employeeId;
        $this->salary = $salary;
    }
}
