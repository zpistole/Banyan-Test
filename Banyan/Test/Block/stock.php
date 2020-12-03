<?php 

namespace Banyan\Test\Block;

use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class Stock extends Template 
{
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
        $this->stockRegistry = $stockRegistry;
    }

    public function getStockInfo() {
        //1. Fetch the product model 
        $product = $this->getProduct();

        //2. Get the qty from the product model 
        $stock = $this->stockRegistry->getStockItem($product->getId());
        
        //3. Retun it here 
        return $stock->getQty();
    }

    protected function getProduct() {
        return $this->registry->registry('product');
    }
}