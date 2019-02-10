<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\PageBuilderDataMigration\Setup\DataConverter\Renderer;

use Magento\PageBuilderDataMigration\Setup\DataConverter\RendererInterface;
use Magento\PageBuilderDataMigration\Setup\DataConverter\EavAttributeLoaderInterface;
use Magento\PageBuilderDataMigration\Setup\DataConverter\StyleExtractorInterface;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Render accordions to PageBuilder format
 */
class Accordion implements RendererInterface
{
    /**
     * @var StyleExtractorInterface
     */
    private $styleExtractor;

    /**
     * @var EavAttributeLoaderInterface
     */
    private $eavAttributeLoader;

    /**
     * @var EavAttributeLoaderInterface
     */
    private $itemEavAttributeLoader;

    /**
     * @var Json
     */
    private $serializer;

    /**
     * @param StyleExtractorInterface $styleExtractor
     * @param EavAttributeLoaderInterface $eavAttributeLoader
     * @param EavAttributeLoaderInterface $itemEavAttributeLoader
     * @param Json $serializer
     */
    public function __construct(
        StyleExtractorInterface $styleExtractor,
        EavAttributeLoaderInterface $eavAttributeLoader,
        EavAttributeLoaderInterface $itemEavAttributeLoader,
        Json $serializer
    ) {
        $this->styleExtractor = $styleExtractor;
        $this->eavAttributeLoader = $eavAttributeLoader;
        $this->itemEavAttributeLoader = $itemEavAttributeLoader;
        $this->serializer = $serializer;
    }

    /**
     * @inheritdoc
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function render(array $itemData, array $additionalData = []) : string
    {
        if (!isset($itemData['entityId'])) {
            throw new \InvalidArgumentException('entityId is missing.');
        }
        $eavData = $this->eavAttributeLoader->load($itemData['entityId']);

        $rootElementAttributes = [
            'data-mage-init' => $this->getMageInitValue($itemData),
            'class' => 'pagebuilder-accordion ' . ($eavData['css_classes'] ?? '')
        ];

        $rootElementAttributes['class'] = rtrim($rootElementAttributes['class']);

        if (isset($itemData['formData'])) {
            $style = $this->styleExtractor->extractStyle($itemData['formData']);
            if ($style) {
                $rootElementAttributes['style'] = $style;
            }
        }

        $accordionHtml = '<div';
        foreach ($rootElementAttributes as $attributeName => $attributeValue) {
            $accordionHtml .= $attributeValue ? " $attributeName=\"$attributeValue\"" : '';
        }
        $accordionHtml .= '>' . (isset($additionalData['children']) ? $additionalData['children'] : '') . '</div>';

        $rootElementHtml = '<div data-element="main" data-role="html" data-appearance="default">';
        $rootElementHtml .= $accordionHtml . '</div>';

        return $rootElementHtml;
    }

    /**
     * Get data-mage-init attribute value
     *
     * @param array $itemData
     *
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getMageInitValue(array $itemData) : string
    {
        $children = isset($itemData['children']['accordion_items']) ? $itemData['children']['accordion_items'] : null;
        return htmlentities(
            $this->serializer->serialize(
                [
                    'accordion' => [
                        'active' => !empty($children) ? $this->getActiveItem($children) : [0],
                        'collapsibleElement' => '[data-collapsible=true]',
                        'content' => '[data-content=true]'
                    ]
                ]
            )
        );
    }

    /**
     * Determine which accordion items are active
     *
     * @param array $children
     *
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getActiveItem(array $children) : array
    {
        $active = [];
        foreach ($children as $index => $child) {
            if (!isset($child['entityId'])) {
                throw new \InvalidArgumentException('entityId is missing.');
            }
            $eavData = $this->itemEavAttributeLoader->load($child['entityId']);
            if (isset($eavData['open_on_load']) && $eavData['open_on_load']) {
                $active[] = $index;
            }
        }

        if (empty($active)) {
            $active = [0];
        }

        return $active;
    }
}