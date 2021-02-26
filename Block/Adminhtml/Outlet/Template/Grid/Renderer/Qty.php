<?php

namespace Lof\Outlet\Block\Adminhtml\Outlet\Template\Grid\Renderer;

/**
 * Renderer for Remain Qty field in sales create new order search grid
 *
 * @author
 */
class Qty extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{
    protected $_stockItemRepository;
    protected $typeConfig;
    /**
     * Type config
     *
     * @var \Magento\Catalog\Model\ProductTypes\ConfigInterface
     */
    public function __construct(
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository
    )
    {
        $this->_stockItemRepository = $stockItemRepository;

    }
    public function getStockItem($productId)
    {
        return $this->_stockItemRepository->get($productId)->getQty();
    }


    /**
     * Returns whether this qty field must be inactive
     *
     * @param \Magento\Framework\DataObject $row
     * @return bool
     */
    protected function _isInactive($row)
    {
        return $this->typeConfig->isProductSet($row->getTypeId());
    }

    /**
     * Render product qty field
     *
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $id = $row->getData('entity_id');
        $availQty = $this->getStockItem($id);
        return $availQty;
    }
}