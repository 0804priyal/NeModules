<?php

namespace Chilliapple\Log\Controller\Log;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

/**
 * Class Save
 * @package Chilliapple\Log\Controller\Log
 */
class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Chilliapple\Log\Model\ResourceModel\Log
     */
    protected $logResourceModel;

    /**
     * @var \Chilliapple\Log\Model\LogFactory
     */
    protected $logFactory;

        /**
     * @var AdapterFactory
     */
    protected $adapterFactory;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        Context $context,
        \Chilliapple\Log\Model\LogFactory $logFactory,
        \Chilliapple\Log\Model\ResourceModel\Log $logResourceModel,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem
    ) {
        $this->logFactory = $logFactory;
        $this->logResourceModel = $logResourceModel;
        $this->storeManager = $storeManager;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }


    /**
     * Create product duplicate
     */
    public function execute()
    {
    //    $data = $this->getRequest()->getParams();
    // print_r($data);
        $userData = $this->logFactory->create();
        $log = $this->getRequest()->getParam('log');
        $comment = $this->getRequest()->getParam('comment');
        $data = [
            'log' => $log,
            'comment' => $comment,
        ];
       
        $userData->addData($data);
        $this->logResourceModel->save($userData);
        $this->messageManager->addSuccessMessage(__('The Log has been saved.'));
        if (!empty($productErrors)) {
            foreach ($productErrors as $message) {
                $this->messageManager->addErrorMessage($message);
            }
        }
        try {

            if (count($data) > 0) {
              //  $this->messageManager->addSuccessMessage(__('The Log has been saved.'));
            } else {
                $this->messageManager->addErrorMessage(__('Unable to save Log.'));
            }
            $this->_redirect('*/*/index');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->_redirect('*/*/index');
        }
    }
}
