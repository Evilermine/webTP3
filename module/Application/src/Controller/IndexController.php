<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Services\CatalogueTable;
use Application\Form\ProductForm;
use Application\Models\Product;
use Application\Services\BasketManager;

class IndexController extends AbstractActionController
{
    private $_table;

    public function __construct(CatalogueTable $table){
        $this->_table = $table;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function catalogueAction() {
        return new ViewModel([
            'products' => $this->_table->fetchAll(),
        ]);
    }

    public function basketAction(){
        $basket = new Basket();

        return new ViewModel();
    }

    public function addProductAction(){
        $id = (int)$this->params()->fromRoute('id', -1);
           
        $product = new Product();
        $form = new ProductForm('product-form');
            
        if ($this->getRequest()->isPost()) {
            
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            $this->_table->insert($data);
            
            return  $this->redirect()->toRoute('catalogue');
            /*
            $data = array_merge_recursive([
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            ]);

            //$imageURL = $data[1]["imageURL"]["tmp_name"];

            $form->setData($data);
            var_dump($form);
            if($form->isValid()) {
                $data = $form->getData();
                var_dump($data);
            }               
            */
        } else {
            $form->setData([
                    'productName'=>$product->productName,
                    'productPrice'=>$product->productPrice,
                    'productDesc'=>$product->productDesc,
                    'imageURL'=>$product->imageURL,
                ]);
        }  
            
            
        return new ViewModel(array(
            'product' => $product,
            'form' => $form
        ));

    }
}
