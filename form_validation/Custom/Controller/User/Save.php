<?php

namespace Nethues\Custom\Controller\User;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

/**
 * Class Save
 * @package Nethues\Custom\Controller\User
 */
class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Nethues\Custom\Model\ResourceModel\User
     */
    protected $userResourceModel;

    /**
     * @var \Nethues\Custom\Model\userFactory
     */
    protected $userFactory;

    /**
     * @var UploaderFactory
     */
    protected $uploaderFactory;

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
        \Nethues\Custom\Model\UserFactory $userFactory,
        \Nethues\Custom\Model\ResourceModel\User $userResourceModel,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem
    ) {
        $this->userFactory = $userFactory;
        $this->userResourceModel = $userResourceModel;
        $this->storeManager = $storeManager;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }


    /**
     * Create product duplicate
     */
    public function execute()
    {
        $userData = $this->userFactory->create();
        $first_name = $this->getRequest()->getParam('first_name');
        $last_name = $this->getRequest()->getParam('last_name');
        $email = $this->getRequest()->getParam('email');
        $contact_number = $this->getRequest()->getParam('contact_number');
        $other_details = $this->getRequest()->getParam('other_details');
        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'contact_number' => $contact_number,
            'other_details' => $other_details,
        ];
       
        $files = $this->getRequest()->getFiles();
       
        if (isset($files['profile_image']) && !empty($files['profile_image']["name"])) {
            try {
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'profile_image']);
                //check upload file type or extension
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'pdf', 'docx', 'doc']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload', $imageAdapter, 'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(true);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('user/docs');
                $result = $uploaderFactory->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $destinationPath)
                    );
                }
                $imagePath = $result['file'];
                //Set file path with name for save into database
                $data['image'] = $imagePath;
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        $userData->addData($data);
        $this->userResourceModel->save($userData);
        $this->messageManager->addSuccessMessage(__('The User has been saved.'));
        if (!empty($productErrors)) {
            foreach ($productErrors as $message) {
                $this->messageManager->addErrorMessage($message);
            }
        }
        try {

            if (count($data) > 0) {
              //  $this->messageManager->addSuccessMessage(__('The User has been saved.'));
            } else {
                $this->messageManager->addErrorMessage(__('Unable to save User.'));
            }
            $this->_redirect('*/*/index');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->_redirect('*/*/index');
        }
    }
}
