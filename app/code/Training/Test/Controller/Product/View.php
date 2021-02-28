<?php
namespace Training\Test\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class View extends \Magento\Catalog\Controller\Product\View
{
    protected $viewHelper;

    protected $resultForwardFactory;

    protected $resultPageFactory;

    protected $customerSession;

    protected $redirectFactory;

    public function __construct(
        Context $context,
        \Magento\Catalog\Helper\Product\View $viewHelper,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
    ) {
        parent::__construct($context, $viewHelper, $resultForwardFactory, $resultPageFactory);
        $this->viewHelper = $viewHelper;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->customerSession = $customerSession;
        $this->redirectFactory = $redirectFactory;
    }

    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->redirectFactory->create()->setPath('customer/account/login');
        } else {
            return parent::execute();
        }
    }
}
