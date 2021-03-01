<?php

namespace Lof\Outlet\Model;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Outlet
 * @package Lof\Outlet\Model
 */
class Outlet extends AbstractModel
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Lof\Outlet\Model\ResourceModel\Outlet');
    }
}
