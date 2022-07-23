<?php

 
namespace Chilliapple\Log\Controller\Adminhtml\Log;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Chilliapple\Log\Model\ResourceModel\Log\CollectionFactory;

class MassEnable extends Action
{

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * MassEnable constructor.
     * @param CollectionFactory $collectionFactory
     * @param Filter $filter
     * @param Context $context
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Filter $filter,
        Context $context
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $ownerCollection = $this->filter->getCollection($this->collectionFactory->create());
        foreach ($ownerCollection as $item) {
            $item->setStatus(true);
            $item->save();
        }

        $this->messageManager->addSuccessMessage(
            __(
                'A total of %1 record(s)
                have been enabled.', $ownerCollection->getSize()
            )
        );

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
