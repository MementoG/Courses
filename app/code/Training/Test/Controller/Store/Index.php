<?php
namespace Training\Test\Controller\Store;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonResultFactory;

    /**
     * @var \Magento\CatalogInventory\Model\Stock\StockItemRepository
     */
    private $stockItemRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
    ) {
        parent::__construct($context);
        $this->jsonResultFactory = $jsonResultFactory;
        $this->stockItemRepository = $stockItemRepository;
    }
    public function execute()
    {
        $productId = $this->getRequest()->getParam('id');
        $result = $this->jsonResultFactory->create();
        $result->setData(json_encode($this->getCountStore($productId)));
        return $result;
    }
    /**
     * Get random review data
     *
     * Assume it will be retrived from DB
     *
     * @return array
     */
    private function getCountStore($productId)
    {
        return ['qty' => $this->stockItemRepository->get($productId)->getQty()];
    }
}
