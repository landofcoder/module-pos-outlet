<?php

namespace Lof\Outlet\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Module\Manager;
use Magento\Inventory\Model\ResourceModel\Source\Collection;

class MultiSourceOption extends AbstractSource

{
    protected $sourceData;
    protected $_moduleManager;

    /**
     * Constructor call.
     * @param Collection $sourceData
     * @param Manager $moduleManager
     */
    public function __construct(
        Collection $sourceData,
        Manager $moduleManager
    )
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
        $dataSources = $this->sourceData->getData();
        foreach ($dataSources as $item) {
            if (isset($item['source_code'])) {
                $this->_options[] = [
                    'label' => $item['name'], 'value' => $item['source_code']
                ];
            }
        }
        return $this->_options;
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
