<?php
namespace Lof\Outlet\Controller\Adminhtml\Outlet;

use Magento\Catalog\Model\Product;
use Magento\Framework\App\Action\Action;

class AsscociateProducts extends  Action
{
    /**
     * Product $product
     */
    private $product;

    public function __construct(
        Product $product
    ) {
        $this->product = $product;
    }

    public function execute()
    {
        $id = 1; // id of a configurable product
        $configurable = $this->product->load($id);
        $children = $configurable
            ->getTypeInstance()
            ->getUsedProducts($configurable);
        foreach ($children as $child) {
            echo $child->getEntityId();
        }
    }
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Lof_Outlet::outlet');
    }
}