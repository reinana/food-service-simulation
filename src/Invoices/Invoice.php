<?php

namespace Invoices;

use DateTime;

final class Invoice
{
    private float $finalPrice;
    private DateTime $orderTime;
    private int $estimatedTimeInMinutes;

    public function __construct(float $finalPrice, DateTime $orderTime, int $estimatedTimeInMinutes)
    {
        $this->finalPrice = $finalPrice;
        $this->orderTime = $orderTime;
        $this->estimatedTimeInMinutes = $estimatedTimeInMinutes;
    }
    public function printeInvoice(): void
    {
        echo "----- Invoice -----\n";
        echo "Final Price: {$this->finalPrice}\n";
        echo "Order Time: {$this->orderTime->format('Y-m-d H:i:s')}\n";
        echo "-------------------\n";
    }

    public function getFinalPrice(): float
    {
        return $this->finalPrice;
    }
    public function getOrderTime(): DateTime
    {
        return $this->orderTime;
    }
    public function getEstimatedTimeInMinutes(): int
    {
        return $this->estimatedTimeInMinutes;
    }
}

?>