<?php

namespace Lof\Outlet\Controller\Adminhtml\Outlet;

use Lof\Outlet\Controller\Adminhtml\Outlet;
use Magento\Backend\App\Action;
use Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor;

class Save extends Action

{
    protected $outletfactory;
    protected $dataProcessor;
    public function __construct(Action\Context $context,
                                \Lof\Outlet\Model\OutletFactory $outletFactory,
                                PostDataProcessor $dataProcessor)
    {
        parent::__construct($context);
        $this->outletfactory=$outletFactory;
        $this->dataProcessor=$dataProcessor;
    }


    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
//            $data = $this->dataProcessor->filter($data);
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
        // Check if 'Save and Continue'
                    if ($this->getRequest()->getParam('back')) {
                        $this->_redirect('*/outlet/edit', ['outlet_id' => $model->getId(), '_current' => true]);
                        return;
                    }

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Outlet.'));
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