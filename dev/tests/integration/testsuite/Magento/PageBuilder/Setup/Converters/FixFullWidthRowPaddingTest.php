<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\PageBuilder\Setup\Converters;

use Magento\Framework\ObjectManagerInterface;

class FixFullWidthRowPaddingTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    protected function setUp()
    {
        $this->objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
    }

    /**
     * @dataProvider conversionData
     */
    public function testConvert(string $htmlString, string $expectedResult)
    {
        $fixFullWidthRowPadding = $this->objectManager->create(FixFullWidthRowPadding::class);
        $result = $fixFullWidthRowPadding->convert($htmlString);
        $this->assertContains($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function conversionData(): array
    {
        return [
            // one contained row, one full-width row
            [
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div class="row-full-width-inner" data-element="inner"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full-width</span></div></div></div></div></div>',
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; "><div class="row-full-width-inner" data-element="inner" style="padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full-width</span></div></div></div></div></div>',
            ],
            // one contained, no full-width
            [
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>',
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>',
            ],
            // one full-width row
            [
                '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div class="row-full-width-inner" data-element="inner"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full-width</span></div></div></div></div></div>',
                '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; "><div class="row-full-width-inner" data-element="inner" style="padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full-width</span></div></div></div></div></div>',
            ],
            // one contained, 2 full-width
            [
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div class="row-full-width-inner" data-element="inner"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full-width</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div class="row-full-width-inner" data-element="inner"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full-width</span></div></div></div></div></div>',
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; "><div class="row-full-width-inner" data-element="inner" style="padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full-width</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; "><div class="row-full-width-inner" data-element="inner" style="padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full-width</span></div></div></div></div></div>',
            ],
            // one contained, one full-bleed, one full-width
            [
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div class="row-full-width-inner" data-element="inner"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full width</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-bleed" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full bleed</span></div></div></div></div>',
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; "><div class="row-full-width-inner" data-element="inner" style="padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full width</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-bleed" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full bleed</span></div></div></div></div>'
            ],
            // one full-width with custom paddings
            [
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 40px;"><div class="row-full-width-inner" data-element="inner"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full width</span></div></div></div></div></div>',
                '<div data-content-type="row" data-appearance="contained" data-element="main"><div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="inner" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; padding: 10px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">contained</span></div></div></div></div></div>'
                . '<div data-content-type="row" data-appearance="full-width" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 10px; "><div class="row-full-width-inner" data-element="inner" style="padding: 40px;"><div data-content-type="buttons" data-appearance="inline" data-same-width="false" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 10px 10px 0px;"><div data-content-type="button-item" data-appearance="default" data-element="main" style="display: inline-block;"><div class="pagebuilder-button-primary" data-element="empty_link" style="text-align: center;"><span data-element="link_text">full width</span></div></div></div></div></div>'
            ]
        ];
    }

}
