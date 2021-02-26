<?php

namespace Lof\Outlet\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
class Actions extends Column
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /** Url Path */
    const URL_PATH_EDIT = '';

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = array(),
        UrlInterface $urlBuilder,
        array $data = array())
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return void
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['outlet_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl('lofoutlet/outlet/edit', ['id' => $item['outlet_id']]),
                        'label' => __('Edit')
                    ];

                }
            }
        }
        return $dataSource;
    }
}