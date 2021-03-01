<?php
namespace Training\Test\Plugin\Block\Product\View;

class Description extends \Magento\Catalog\Block\Product\View\Description
{
//    public function beforeToHtml(
//        \Magento\Catalog\Block\Product\View\Description $subject
//    ) {
//        $subject->getProduct()->setDescription('Test description');
//    }
//    public function beforeToHtml(
//        \Magento\Catalog\Block\Product\View\Description $subject
//    ) {
//        $subject->setTemplate('Training_Test::description.phtml');
//    }
    public function beforeToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject
    ) {
        if ($subject->getNameInLayout() === 'product.info.sku') {
            $subject->setTemplate('Training_Test::description.phtml');
        }
    }
}
