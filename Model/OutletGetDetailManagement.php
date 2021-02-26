<?php
namespace Lof\Outlet\Model;

use Lof\Outlet\Api\OutletGetDetailManagementInterface;
use Lof\Outlet\Model\ResourceModel\Outlet\CollectionFactory;

class OutletGetDetailManagement implements OutletGetDetailManagementInterface
{

    protected $Outlet;

    protected $collectionFactory;


    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Lof\Outlet\Model\OutletFactory $Outlet,
        CollectionFactory $collectionFactory

    ) {

        $this->collectionFactory = $collectionFactory;
        $this->Outlet = $Outlet;
    }
    public function getDetailOutlet($id)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('outlet_id',$id);
        $arrResult = [];
        foreach ($collection->getItems() as $outlet) {

             $arrResult[]['data'] = $outlet->getData();
        }
        return $arrResult;
    }

}