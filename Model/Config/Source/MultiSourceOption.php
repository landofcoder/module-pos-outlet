<?php

namespace Lof\Outlet\Model\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;
use Magento\Framework\DB\Ddl\Table;

class MultiSourceOption extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource

{
    protected $sourceData;
    protected $_moduleManager;

    /**
     * Constructor call.
     * @param \Magento\Inventory\Model\ResourceModel\Source\Collection $sourceData
     */
    public function __construct(
        \Magento\Inventory\Model\ResourceModel\Source\Collection $sourceData,
        \Magento\Framework\Module\Manager $moduleManager)
    {
        $this->sourceData = $sourceData;
        $this->_moduleManager = $moduleManager;
    }

    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_moduleManager->isEnabled('Lof_Inventory')) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

            $collectionFactory = $objectManager->create('\Lof\Inventory\Model\WarehouseFactory');
            $model = $collectionFactory->create();
            $getDataWarehouse = $model->getCollection()->getData();
            $getDataSource = $this->sourceData->getData();
            $allWarehouse = array_merge($getDataWarehouse, $getDataSource);
            foreach ($allWarehouse as $item) {
                if (isset($item['warehouse_id'])) {
                    $this->_options[] = [
                        'label' => $item['warehouse_name'], 'value' => $item['warehouse_code']
                    ];
                } elseif (isset($item['source_code'])) {
                    $this->_options[] = [
                        'label' => $item['name'], 'value' => $item['source_code']
                    ];
                }
            }
        return $this->_options;
        }
    }

    /**
     * Get a text for option value
     *
     * @param string|integer $value
     * @return string|bool
     */
    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
}