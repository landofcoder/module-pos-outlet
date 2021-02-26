<?php

namespace Lof\Outlet\Api;

interface OutletGetDetailManagementInterface
{
    /**
     *  GET for OutletGetDetail api
     * @param string $id
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function getDetailOutlet($id);
}
