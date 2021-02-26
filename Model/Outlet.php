<?php

namespace Lof\Outlet\Model;
use Magento\Framework\Model\AbstractModel;

class Outlet extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Lof\Outlet\Model\ResourceModel\Outlet');
    }
}