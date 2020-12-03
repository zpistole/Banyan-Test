<?php 

namespace Banyan\Test\Block;

use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class Stock extends Template 
{
    //private local variables 
    private $registry; 
    private $stockRegistry;

    //dependency injection
    //load different objects needed into the contructor 
    //for different data i.e. registry and stockregistry 
    public function __construct(
        Template\Context $context,
        //registry is where Magento keeps the current 
        //product when the page is loaded 
        //used for getProduct()
        Registry $registry, 

        //stockregistry is where stock data is stored
        //used for getQty()
        StockRegistryInterface $stockRegistry,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->stockRegistry = $stockRegistry;
    }

    //function that returns the quantity number 
    //that will be passed to stock.phtml 
    public function getStockInfo() {
        //Fetch the product model 
        $product = $this->getProduct();

        //Get the quantity from the product model 
        $stock = $this->stockRegistry->getStockItem($product->getId());

        //Retun stock quantity here  
        return $stock->getQty();
    }

    //function that returns the product model
    //returns an object of the product class with the key: 'product'
    protected function getProduct() {
        return $this->registry->registry('product');
    }
}