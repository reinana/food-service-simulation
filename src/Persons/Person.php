<?php 
declare(strict_types=1);
namespace Persons;
abstract class Person {
    protected string $name;
    protected int $age;
    protected string $address;

    public function __construct(string $name, int $age, string $address) {
        $this->name = $name;
        $this->age = $age;
        $this->address = $address;
    }

    public function getName(): string {
        return $this->name;
    }
    public function getAge(): int {
        return $this->age;
    }
    public function getAddress(): string {
        return $this->address; 
    }
}
?>