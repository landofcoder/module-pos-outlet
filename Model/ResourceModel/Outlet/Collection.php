<?php


namespace Lof\Outlet\Model\ResourceModel\Outlet;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;


class Collection extends AbstractCollection

{
    protected $_idFieldName = 'outlet_id';

    protected function _construct()
    {

        $this->_init(
            'Lof\Outlet\Model\Outlet',
            'Lof\Outlet\Model\ResourceModel\Outlet');

    }

}