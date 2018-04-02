<?php

namespace Application\Models;

class Product {

    private $productId;
    private $productName;
    private $productDesc;
    private $productPrice;
    private $imageURL;

  public function __construct(){

  } 

  public function exchangeArray($data){
      $this->productId = (!empty($data['productId'])) ? $data['productId'] : null;
      $this->productName = (!empty($data['productName'])) ? $data['productName'] : null;
      $this->productDesc = (!empty($data['productDesc'])) ? $data['productDesc'] : null;
      $this->productPrice = (!empty($data['productPrice'])) ? $data['productPrice'] : null;
      $this->imageURL = (!empty($data['imageURL'])) ? $data['imageURL'] : null;
  }

  public function toValues(){
      return [
          'productId' => $this->productId,
          'productName' => $this->productName,
          'productDesc' => $this->productDesc,
          'productPrice' => $this->productPrice,
          'imageURL' => $this->imageURL
      ];
  }
}
?>