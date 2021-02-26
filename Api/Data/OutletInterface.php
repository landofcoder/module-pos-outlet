<?php

namespace Lof\Outlet\Api\Data;

/**
 * Outlet interface.
 * @api
 * @since 100.0.2
 */
interface OutletInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const OUTLET_ID = 'outlet_id';
    const OUTLET_NAME = 'outlet_name';
    const OUTLET_STATUS = 'status';
    const OUTLET_ASSIGNMENT = 'assignment';
    const OUTLET_DEFAUTL_CUSTOMER = 'default_customer';
    const OUTLET_ADDRESS = 'outlet_address';
    const OUTLET_SELECT_SOURCE = 'select_source';
    const OUTLET_CUSTOMER = 'customer';
    const OUTLET_CUSTOMER_ADDRESS = 'address';
    const OUTLET_SELECT_RECEIPT= 'select_receipt';
    const OUTLET_CATEGORY= 'parent';

    /**
     * Get outlet_id
     *
     * @return int|null
     */
    public function getOutletId();

    /**
     * Get outlet_name
     *
     * @return string|null
     */
    public function getOutletName();

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Get assignment
     *
     * @return string|null
     */
    public function getAssignment();

    /**
     * Get default_customer
     *
     * @return int
     *
     */
    public function getDefaultCustomer();

    /**
     * Get outlet_address
     *
     * @return string|null
     */
    public function getOutletAddress();

    /**
     * Get select_source
     *
     * @return string|null
     */
    public function getSelectSource();

    /**
     * Get customer
     *
     * @return string|null
     */
    public function getCustomer();

    /**
     * Get address
     *
     * @return string|null
     */
    public function getAddress();
    /**
     * Get select_receipt
     *
     * @return string|null
     */
    public function getSelectReceipt();
    /**
     * Get parent
     *
     * @return string|null
     */
    public function getParent();

    /**
     * Set outlet_id
     *
     * @param int $id
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setOutletId($id);

    /**
     * Set outlet_name
     *
     * @param string $outlet_name
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setOutletName($outlet_name);

    /**
     * Set status
     *
     * @param int $status
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setStatus($status);

    /**
     * Set assignment
     *
     * @param string $assignment
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setAssignment($assignment);

    /**
     * Set default_customer
     *
     * @param int $default_customer
     * @return \Lof\Outlet\Api\Data\OutletInterface
     *
     */
    public function setDefaultCustomer($default_customer);

    /**
     * Set outlet_address
     *
     * @param string $outlet_address
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setOutletAddress($outlet_address);

    /**
     * Set select_source
     *
     * @param string $select_source
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setSelectSource($select_source);

    /**
     * Set customer
     *
     * @param string $customer
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setCustomer($customer);

    /**
     * Set address
     *
     * @param string $address
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setAddress($address);
    /**
     * Set select_receipt
     *
     * @param string $select_receipt
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setSelectReceipt($select_receipt);
    /**
     * Set parent
     *
     * @param string $parent
     * @return \Lof\Outlet\Api\Data\OutletInterface
     */
    public function setParent($parent);

}