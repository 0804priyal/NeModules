<?php

namespace Cloudways\Newmodule\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

/**
 * Class Save
 * @package Cloudways\Newmodule\Controller\Index
 */
class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Cloudways\Newmodule\Model\ResourceModel\Data
     */
    protected $dataResourceModel;

    /**
     * @var \Cloudways\Newmodule\Model\dataFactory
     */
    protected $dataFactory;

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
        \Cloudways\Newmodule\Model\DataFactory $dataFactory,
        \Cloudways\Newmodule\Model\ResourceModel\Data $dataResourceModel,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem
    ) {
        $this->dataFactory = $dataFactory;
        $this->dataResourceModel = $dataResourceModel;
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
        $userData = $this->dataFactory->create();
        $log = $this->getRequest()->getParam('log');
        $comment = $this->getRequest()->getParam('comment');
        $data = [
            'log' => $log,
            'comment' => $comment,
        ];
       
        $userData->addData($data);
        $this->dataResourceModel->save($userData);
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
