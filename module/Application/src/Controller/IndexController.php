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

    public function catalogueAction(){
        return new ViewModel([
            'products' => $this->_table->fetchAll(),
        ]);
    }

    public function addProductAction(){
        $id = (int)$this->params()->fromRoute('id', -1);
           
        $product = new Product();
        $form = new ProductForm($product);
            
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();            
            
            $form->setData($data);
            
            $this->_table->insert($data);
            
            return $this->redirect()->toRoute('catalogue');                             
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
