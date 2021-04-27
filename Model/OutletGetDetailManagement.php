<?php
namespace Lof\Outlet\Model;

use Lof\Outlet\Api\OutletGetDetailManagementInterface;
use Lof\Outlet\Model\ResourceModel\Outlet\CollectionFactory;

/**
 * Class OutletGetDetailManagement
 * @package Lof\Outlet\Model
 */
class OutletGetDetailManagement implements OutletGetDetailManagementInterface
{

    /**
     * @var OutletFactory
     */
    protected $outlet;

    /**
     * @var
     */
    protected $collectionFactory;

    /**
     * OutletGetDetailManagement constructor.
     * @param OutletFactory $outlet
     */
    public function __construct(
        OutletFactory $outlet
    ) {
        $this->outlet = $outlet;
    }

    /**
     * @param int $id
     * @return array|mixed
     */
    public function getDetailOutlet($id)
    {
        $outlet = $this->outlet->create()->load($id);
        return $outlet->getData();
    }

}
