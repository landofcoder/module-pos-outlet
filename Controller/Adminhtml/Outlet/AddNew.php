<?php
namespace Lof\Outlet\Controller\Adminhtml\Outlet;

use Lof\Outlet\Model\Outlet;
use Lof\Outlet\Model\OutletFactory;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class AddNew extends Action
{
    protected $pageFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory =$pageFactory;
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Lof_Outlet::outlet_edit');
    }
}