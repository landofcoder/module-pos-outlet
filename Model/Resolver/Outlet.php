<?php
/**
 * Copyright © LandOfCoder All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Lof\Outlet\Model\Resolver;

use Lof\Outlet\Api\OutletGetDetailManagementInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\GraphQl\Model\Query\ContextInterface;


/**
 * Class Outlet
 * @package Lof\Outlet\Model\Resolver
 */
class Outlet implements ResolverInterface
{

    /**
     * @var OutletGetDetailManagementInterface
     */
    private $outletManagement;


    /**
     * Outlet constructor.
     * @param OutletGetDetailManagementInterface $outletManagement
     */
    public function __construct(
        OutletGetDetailManagementInterface $outletManagement
    ) {
        $this->outletManagement = $outletManagement;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        /** @var ContextInterface $context */
        if (!$context->getUserId()) {
            throw new GraphQlAuthorizationException(__('The current user isn\'t authorized.'));
        }
        return $this->outletManagement->getDetailOutlet($args['id']);
    }
}

