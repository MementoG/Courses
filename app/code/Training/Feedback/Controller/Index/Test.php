<?php
namespace Training\Feedback\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
    private $feedbackFactory;
    private $feedbackRepository;
    private $searchCriteriaBuilder;
    private $sortOrderBuilder;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Training\Feedback\Api\Data\FeedbackInterfaceFactory $feedbackFactory,
        \Training\Feedback\Api\Data\FeedbackRepositoryInterface $feedbackRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context);
    }
    public function execute()
    {
        // create new item
        $newFeedback = $this->feedbackFactory->create();
        $newFeedback->setAuthorName('some name');
        $newFeedback->setAuthorEmail('test@test.com');
        $newFeedback->setMessage('ghj dsghjfghs sghkfgsdhfkj sdhjfsdf gsfkj');
        $newFeedback->setIsActive(1);
        $this->feedbackRepository->save($newFeedback);
        // load item by id
        $feedback = $this->feedbackRepository->getById(3);
        $this->printFeedback($feedback);
        // update item
        $feedbackToUpdate = $this->feedbackRepository->getById(3);
        $feedbackToUpdate->setMessage('CUSTOM ' . $feedbackToUpdate->getMessage());
        // delete feedback
        $this->feedbackRepository->deleteById(3);
        // load multiple items
        $this->searchCriteriaBuilder
            ->addFilter('is_active', 1);
        $sortOrder = $this->sortOrderBuilder
            ->setField('message')
            ->setAscendingDirection()
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->feedbackRepository->getList($searchCriteria);
        foreach ($searchResult->getItems() as $item) {
            $this->printFeedback($item);
        }
        exit();
    }
    private function printFeedback($feedback)
    {
        echo $feedback->getId() . ' : '
            . $feedback->getAuthorName()
            . ' (' . $feedback->getAuthorEmail() . ')';
        echo "<br/>\n";
    }
}
