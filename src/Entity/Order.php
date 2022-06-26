<?php
namespace  App\Entity;


class Order {

    private string $order_id;
    private string $order_date;
    private float $total_order_value;
    private float $average_unit_price;
    private int $unit_count;
    private string $customer_state;
    
    public function getOrderID() : string {
        return $this->order_id;
    }

    public function setOrderID(string $orderid) : void {
        $this->order_id = $orderid;
    }

    public function getOrderDate() : string{
        return $this->order_date;
    }

    public function setOrderDate(string $order_date) : void {
        $this->order_date = $order_date;
    }

    public function getTotalOrderValue() : float {
        return $this->total_order_value;
    }

    public function setTotalOrderValue(float $total_order_value) : void {
        $this->total_order_value = $total_order_value;
    }

    public function getAverageUnitPrice() : float {
        return $this->average_unit_price;
    }

    public function setAverageUnitPrice(float $average_unit_price) : void {
        $this->average_unit_price = $average_unit_price;
    }

    public function getUnitCount() : int {
        return $this->unit_count;
    }

    public function setUnitCount(int $unit_count) : void {
        $this->unit_count = $unit_count;
    }

    public function getCustomerState(): string {
        return $this->customer_state;
    }

    public function setCustomerState(string $customer_state) : void {
        $this->customer_state = $customer_state;
    }
}
