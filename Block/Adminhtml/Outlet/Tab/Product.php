<?php

namespace Lof\Outlet\Block\Adminhtml\Outlet\Tab;
use Magento\Backend\Block\Widget\Grid;
use Magento\Backend\Block\Widget\Grid\Column;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Framework\App\ObjectManager;
class Product extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productFactory;
    /**
     * @var Status
     */
    private $status;
    /**
     * @var Visibility
     */
    private $visibility;
    /**
     * @var \Magento\Catalog\Model\Product\Type
     */
    protected $_type;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param array $data
     * @param Visibility|null $visibility
     * @param Status|null $status
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Catalog\Model\Product\Type $type,

        array $data = []

    ) {
        $this->_productFactory = $productFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $backendHelper, $data);
        $this->_type = $type;
    }
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
//        $this->setId('catalog_category_products');
        $this->setDefaultSort('entity_id');
        $this->setUseAjax(true);
    }

    /**
     * @param Column $column
     * @return $this
     */
    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in category flag
        if ($column->getId() == 'in_category') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', ['in' => $productIds]);
            } elseif (!empty($productIds)) {
                $this->getCollection()->addFieldToFilter('entity_id', ['nin' => $productIds]);
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }
    /**
     * @return array|null
     */
    public function getProduct()
    {
        return $this->_coreRegistry->registry('catalog');
    }
    /**
     * Checks when this block is readonly
     *
     * @return bool
     */
    public function isReadonly()
    {
        return $this->getProduct() && $this->getProduct()->getProductsReadonly();
    }
    /**
     * @return Grid
     */
    /**
     * @return Grid
     */
    protected function _prepareCollection()
    {
        if ($this->getProduct() && $this->getProduct()->getId()) {
            $this->setDefaultFilter(['in_category' => 1]);
        }
        $collection = $this->_productFactory->create()->getCollection()->addAttributeToSelect(
            '*'
        );
        $storeId = (int)$this->getRequest()->getParam('store', 0);
        if ($storeId > 0) {
            $collection->addStoreFilter($storeId);
        }
        $this->setCollection($collection);

        if ($this->getProduct() && $this->getProduct()->getProductsReadonly()) {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            $this->getCollection()->addFieldToFilter('entity_id', ['in' => $productIds]);
        }

        return parent::_prepareCollection();
    }
    /**
     * @return Extended
     */
    protected function _prepareColumns()
    {
        if (!$this->isReadonly()) {
            $this->addColumn(
                'in_category',
                [
                    'header' => __('ID'),
                    'name' => 'entity_id',
                    'values' => $this->_getSelectedProducts(),
                    'index' => 'entity_id',
                    'header_css_class' => 'col-select col-massaction',
                    'column_css_class' => 'col-select col-massaction'
                ]
            );
        }

        $this->addColumn(
            'image',
            array(
                'header' => __('Thumbnail'),
                'align' => 'center',
                'index' => 'image',
                'width'     => '90',
                'renderer'  => '\Lof\Outlet\Block\Adminhtml\Outlet\Template\Grid\Renderer\Image',
            )
        );
        $this->addColumn('name', ['header' => __('Name'), 'index' => 'name']);
        $this->addColumn(
            'product_type',
            [
                'header' => __('Type'),
                'index' => 'type_id',
                'type' => 'options',
                'options' => $this->_type->getOptionArray(),
                'header_css_class' => 'col-type',
                'column_css_class' => 'col-type'
            ]
        );

        $this->addColumn(
            'qty',
            array(
                'header' => __('Quantity'),
                'index' => 'qty',
                'renderer'  => '\Lof\Outlet\Block\Adminhtml\Outlet\Template\Grid\Renderer\Qty',
            )
        );
        return parent::_prepareColumns();
    }


    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('lofoutlet/*/grid', ['_current' => true]);
    }
    /**
     * @return array
     */
    protected function _getSelectedProducts()
    {
        $products = $this->getRequest()->getPost('selected_products');
        if ($products === null && $this->getProduct()) {
            $products = $this->getProduct()->getProductsPosition();
            return array_keys($products);
        }
        return $products;
    }
}