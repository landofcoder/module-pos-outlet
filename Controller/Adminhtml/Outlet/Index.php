<?php
namespace Lof\Outlet\Controller\Adminhtml\Outlet;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * page factory reference
     *
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     * run index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $pageResult = $this->resultPageFactory->create();
        $pageResult->getConfig()->getTitle()->set(__('Outlet Manager'));
        $pageResult->getConfig()->getTitle()->prepend(__('Outlet Manager'));
        $this->_setActiveMenu('outlet_id') //can skip this
        ->_addBreadcrumb(
            __('Outlet'),
            __('Outlet')
        )->_addBreadcrumb(
            __('OutLet List'),
            __('Outlet List')
        );
        return $pageResult;
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