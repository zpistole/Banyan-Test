<?php 

namespace Banyan\Test\Block;

use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class Stock extends Template 
{
    /*public function getDate() {
        return date('Y-m-d');
    }*/

    //private local variable 
    private $registry; 
    private $stockRegistry;

    public function __construct(
        Template\Context $context,
        Registry $registry, 
        StockRegistryInterface $stockRegistry,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
    }

    public function getStockInfo() {
        //1. Fetch the product model 
        //2. Get the qty from the product model 
        //3. Retun it here 
        $product = $this->getProduct();
        $stock = $this->stockRegistry->getStockItem($product->getId());
        return $stock->getQty();
    }

    public function getProduct() {
        return $this->registry->registry('current_products');
    }
}