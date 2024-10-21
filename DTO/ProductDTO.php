<?php

class ProductDTO
{
    // Thuộc tính cho mã sản phẩm
    private $productCode;

    // Thuộc tính cho đường dẫn hình ảnh sản phẩm
    private $imgProduct;

    // Thuộc tính cho tên sản phẩm
    private $nameProduct;

    // Thuộc tính cho mã nhà cung cấp
    private $supplierCode;

    // Thuộc tính cho số lượng sản phẩm
    private $quantity;

    // Thuộc tính cho mô tả sản phẩm
    private $describe;

    // Thuộc tính cho trạng thái sản phẩm
    private $status;

    // Thuộc tính màu sắc sản phẩm
    private $color;

    // Thuộc tính cho đối tượng mục tiêu (ví dụ: nam, nữ)
    private $targetGender;

    // Thuộc tính cho giá sản phẩm
    private $price;

    private $promotion;

    // Constructor
    public function __construct($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price,$promotion)
    {
        $this->productCode = $productCode;
        $this->imgProduct = $imgProduct;
        $this->nameProduct = $nameProduct;
        $this->supplierCode = $supplierCode;
        $this->quantity = $quantity;
        $this->describe = $describe;
        $this->status = $status;
        $this->color = $color;
        $this->targetGender = $targetGender;
        $this->price = $price;
        $this->promotion = $promotion;
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

    // Getter và Setter cho $imgProduct
    public function getImgProduct()
    {
        return $this->imgProduct;
    }

    public function setImgProduct($imgProduct)
    {
        $this->imgProduct = $imgProduct;
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

    // Getter và Setter cho $supplierCode
    public function getSupplierCode()
    {
        return $this->supplierCode;
    }

    public function setSupplierCode($supplierCode)
    {
        $this->supplierCode = $supplierCode;
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

    // Getter và Setter cho $describe
    public function getDescribe()
    {
        return $this->describe;
    }

    public function setDescribe($describe)
    {
        $this->describe = $describe;
    }

    // Getter và Setter cho $status
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    // Getter và Setter cho $targetGender
    public function getTargetGender()
    {
        return $this->targetGender;
    }

    public function setTargetGender($targetGender)
    {
        $this->targetGender = $targetGender;
    }

    // Getter và Setter cho $price
    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    // Getter và Setter cho $color
    public function getColor()
    {
        return $this->color;
    }
    public function setColor($color)
    {
        $this->color = $color;
    }

    

    // Getter và Setter cho $promotion
    public function getPromotion()
    {
        return $this->promotion;
    }

    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
    }

    
}
