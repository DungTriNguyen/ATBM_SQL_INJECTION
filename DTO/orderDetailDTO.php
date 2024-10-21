<?php

class OrderDetailDTO
{
    // Thuộc tính cho mã đơn hàng
    private $orderCode;

    // Thuộc tính cho mã sản phẩm
    private $productCode;

    // Thuộc tính cho tên sản phẩm
    private $nameProduct;

    // Thuộc tính cho số lượng sản phẩm trong đơn hàng
    private $quantity;

    // size 
    private $sizeCode;

    // Thuộc tính giá của từng sản phẩm
    private $priceProduct;

    // Thuộc tính cho tổng số tiền của sản phẩm trong đơn hàng
    private $totalMoney;

    // Constructor
    public function __construct($orderCode, $productCode, $nameProduct, $quantity,$sizeCode, $priceProduct, $totalMoney)
    {
        $this->orderCode = $orderCode;
        $this->productCode = $productCode;
        $this->nameProduct = $nameProduct;
        $this->quantity = $quantity;
        $this->sizeCode = $sizeCode;
        $this->priceProduct = $priceProduct;
        $this->totalMoney = $totalMoney;
    }

    // get set sizeCode
    public function getSizeCode(){
        return $this->sizeCode;
    }

    public function setSizeCode($sizeCode){
        $this->sizeCode = $sizeCode;
    }

    // tinh tong chi tiet don hang

    public function totalMoney()
    {
        $this->totalMoney = $this->quantity * $this->priceProduct;
    }

    // Getter và Setter cho $orderCode
    public function getOrderCode()
    {
        return $this->orderCode;
    }

    public function setOrderCode($orderCode)
    {
        $this->orderCode = $orderCode;
    }

    // Getter và Setter cho $productCode
    public function getProductCode()
    {
        return $this->productCode;
    }

    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

    // Getter và Setter cho $nameProduct
    public function getNameProduct()
    {
        return $this->nameProduct;
    }

    public function setNameProduct($nameProduct)
    {
        $this->nameProduct = $nameProduct;
    }

    // Getter và Setter cho $quantity
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    // Getter và Setter cho $totalMoney
    public function getTotalMoney()
    {
        return $this->totalMoney;
    }

    public function setTotalMoney($totalMoney)
    {
        $this->totalMoney = $totalMoney;
    }

    // Getter và Setter cho $priceProduct
    public function getPriceProduct()
    {
        return $this->priceProduct;
    }

    public function setPriceProduct($priceProduct)
    {
        $this->priceProduct = $priceProduct;
    }
}
