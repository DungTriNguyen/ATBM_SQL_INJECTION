<?php
// require('../DTO/ProductDTO.php');

class HandbagProductDTO extends ProductDTO
{
    // Thuộc tính cho chất liệu của túi xách
    private $bagMaterial;
    private $descriptionMaterial;


    // Constructor
    public function __construct($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price,$promotion, $bagMaterial,$descriptionMaterial)
    {
        // Gọi constructor của lớp cha (Product)
        parent::__construct($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price,$promotion);

        // Thiết lập các thuộc tính mới của HandbagProduct
        $this->bagMaterial = $bagMaterial;
        $this->descriptionMaterial = $descriptionMaterial;
    }

    // Getter và Setter cho $bagMaterial
    public function getBagMaterial()
    {
        return $this->bagMaterial;
    }

    public function setBagMaterial($bagMaterial)
    {
        $this->bagMaterial = $bagMaterial;
    }

    // Getter và Setter cho $descriptionMaterial
    public function getDescriptionMaterial()
    {
        return $this->descriptionMaterial;
    }

    public function setDescriptionMaterial($descriptionMaterial)
    {
        $this->descriptionMaterial = $descriptionMaterial;
    }
}
