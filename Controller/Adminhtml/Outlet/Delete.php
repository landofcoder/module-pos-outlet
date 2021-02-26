<?php
namespace Lof\Outlet\Controller\Adminhtml\Outlet;

use Lof\Outlet\Model\OutletFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Delete extends Action
{
    protected $outletFactory;

    public function __construct(Context $context,OutletFactory $outletFactory)
    {
        parent::__construct($context);
        $this->outletFactory=$outletFactory;
    }
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model=$this->outletFactory->create();
        $model->load($id)->delete();
        $this->messageManager->addSuccessMessage("You have deleted Outlet");
        return $this->_redirect('*/*/index');
    }
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Lof_Outlet::outlet_delete');
    }
}

