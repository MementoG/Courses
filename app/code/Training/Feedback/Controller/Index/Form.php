<?php
namespace Training\Feedback\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Form extends \Magento\Framework\App\Action\Action
{
    private $pageResultFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context
    ) {
        parent::__construct($context);
    }
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
