<?php
namespace Training\Test\Controller\Block;

class Index extends \Magento\Framework\App\Action\Action
{
    private $layoutFactory;

    private $rawResultFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $rawResultFactory
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->rawResultFactory = $rawResultFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Training\Test\Block\Test');
//        $this->getResponse()->appendBody($block->toHtml());
        $result = $this->rawResultFactory->create();
        $result->setHeader('Content-Type', 'text/xml');
        $result->setContents('<root><science>'.$block->toHtml().'</science></root>');
        return $result;
    }
}
