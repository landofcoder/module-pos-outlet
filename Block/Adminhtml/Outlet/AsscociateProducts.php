<?php

namespace Lof\Outlet\Block\Adminhtml\Outlet;
class AsscociateProducts extends \Magento\Backend\Block\Template
{
    /**
     * Block template
     *
     * @var string
     */
    protected $_template =  'Magento_Catalog::catalog/category/edit/assign_products.phtml';
//    protected $_template =  'Lof_Outlet::outlet/category/edit/assign_products.phtml';
    /**
     * @var \Magento\Catalog\Block\Adminhtml\Category\Tab\Product
     */
    protected $blockGrid;
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;
    /**
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->jsonEncoder = $jsonEncoder;
        parent::__construct($context, $data);
    }
    /**
     * Retrieve instance of grid block
     *
     * @return \Magento\Framework\View\Element\BlockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getBlockGrid()
    {
        if (null === $this->blockGrid) {
            $this->blockGrid = $this->getLayout()->createBlock(
                \Lof\Outlet\Block\Adminhtml\Outlet\Tab\Product::class,
                'category.product.grid'
            );
        }
        return $this->blockGrid;
    }
    /**
     * Return HTML of grid block
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getBlockGrid()->toHtml();
    }
    /**
     * @return string
     */
    public function getProductsJson()
    {
        if($this->getProduct()){
            $products = $this->getProduct()->getProductsPosition();
            if (!empty($products)) {
                return $this->jsonEncoder->encode($products);
            }
        }
        return '{}';
    }
    /**
     * Retrieve current category instance
     *
     * @return array|null
     */
    public function getProduct()
    {
        return $this->registry->registry('category');
    }
}