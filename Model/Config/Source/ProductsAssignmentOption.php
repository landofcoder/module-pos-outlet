<?php


namespace Lof\Outlet\Model\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;


class ProductsAssignmentOption extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Option values
     */

    const VALUE_ALL = 'All Products';
    const VALUE_Category = "Category based";

    /**
     * @var optionFactory
     */
    protected $optionFactory;

    /*
     * Retrieve all options array
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label' => __('All Products'), 'value' => self::VALUE_ALL],
            ['label' => __('Category based'), 'value' => self::VALUE_Category],
        ];
        return $this->_options;
    }

    /**
     *  retrive option array
     * @return array
     */
    public function getOptionArray()
    {
        $_options = [];
        foreach($this->getAllOptions() as $option)
        {
            $_options[$option['value']] = $option['label'];
            return $_options;
        }
    }

    /**
     * Get a text for option value
     *
     * @param string|int $value
     * @return string|false
     */
    public function getOptionText($value)
    {
        $options = $this->getAllOptions();
        foreach ($options as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
}