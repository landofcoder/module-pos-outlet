<?php

namespace Lof\Outlet\Controller\Adminhtml\Outlet;

use Lof\Outlet\Model\OutletFactory;
use Magento\Backend\App\Action;
use Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Save
 * @package Lof\Outlet\Controller\Adminhtml\Outlet
 */
class Save extends Action

{
    /**
     * @var OutletFactory
     */
    protected $outletfactory;
    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param OutletFactory $outletFactory
     * @param PostDataProcessor $dataProcessor
     */
    public function __construct(
        Action\Context $context,
        OutletFactory $outletFactory,
        PostDataProcessor $dataProcessor
    ) {
        parent::__construct($context);
        $this->outletfactory = $outletFactory;
        $this->dataProcessor = $dataProcessor;
    }


    /**
     * @return ResponseInterface|Redirect|ResultInterface|void
     */
    public function execute()
    {
        $dataPost = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($dataPost) {
//            $data = $this->dataProcessor->filter($data);
            $data = array_merge($dataPost['outlet'], $dataPost['default_outlet_shipping_address']) ;
            if (empty($data['outlet_id'])) {
                $data['outlet_id'] = null;
            }

            $model = $this->outletfactory->create();

            $id = $this->getRequest()->getParam('outlet_id');
            if ($id) {
                try {
                    $model->load($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This Outlet no longer exists.'));
                    return $resultRedirect->setPath('*/outlet/');
                }
            }

            $model->setData($data);


            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Outlet.'));
                // Check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/outlet/edit', ['id' => $model->getId(), '_current' => true]);
                    return;
                }
                return $resultRedirect->setPath('*/*/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the outlet.'));
            }

            return $resultRedirect->setPath('*/outlet/edit', ['outlet_id' => $this->getRequest()->getParam('outlet_id')]);
        }
        return $resultRedirect->setPath('*/*/index');
    }

    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Lof_Outlet::outlet_save');
    }
}
