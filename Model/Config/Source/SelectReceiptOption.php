<?php

namespace  Lof\Outlet\Model\Config\Source;

class SelectReceiptOption implements \Magento\Framework\Option\ArrayInterface
{
    protected $_moduleManager;
    protected $_moduleList;



    public function __construct(

        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Framework\Module\ModuleListInterface $moduleList) {
        $this->_moduleManager = $moduleManager;
        $this->_moduleList = $moduleList;
    }

    public function checkModuleInstalled($moduleName){
        return $this->_moduleList->has('Lof_PosReceipt');
    }

    /**
     * Return option array
     *
     * @return array
     */
    public function toOptionArray()
    {

        if($this->_moduleManager->isEnabled('Lof_PosReceipt')) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

            $Collection = $objectManager->create('\Lof\PosReceipt\Model\ResourceModel\Receipt\CollectionFactory');
            $collection = $Collection->create();
            $options = [];


            foreach ($collection as $receipt) {
                $options[] = ['label' => $receipt->getReceiptTitle(), 'value' => $receipt->getId()];
            }

            return $options;
        }
        else{
            return $options = [];
        }


    }
}