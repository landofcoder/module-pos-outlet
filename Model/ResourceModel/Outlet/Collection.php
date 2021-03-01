<?php
namespace Lof\Outlet\Model\ResourceModel\Outlet;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;


/**
 * Class Collection
 * @package Lof\Outlet\Model\ResourceModel\Outlet
 */
class Collection extends AbstractCollection

{
    /**
     * @var string
     */
    protected $_idFieldName = 'outlet_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Lof\Outlet\Model\Outlet::class,
            \Lof\Outlet\Model\ResourceModel\Outlet::class
        );
    }

}
