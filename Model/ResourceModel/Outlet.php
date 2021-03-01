<?php
namespace Lof\Outlet\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Outlet
 * @package Lof\Outlet\Model\ResourceModel
 */
class Outlet extends AbstractDb
{
    /**
     *
     */
    protected  function _construct()
    {
        $this->_init('lof_pos_outlet','outlet_id');
    }
}
