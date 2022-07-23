<?php

namespace Product\Attribute\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Save
 * @package Product\Attribute\Controller\Index
 */
class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Product\Attribute\Model\ResourceModel\Form
     */
    protected $formResourceModel;

    /**
     * @var \Product\Attribute\Model\FormFactory
     */
    protected $formFactory;

        /**
     * @var AdapterFactory
     */
    protected $adapterFactory;

    
    protected $transportBuilder;
    protected $inlineTranslation;
    protected $scopeConfig;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        Context $context,
        \Product\Attribute\Model\FormFactory $formFactory,
        \Product\Attribute\Model\ResourceModel\Form $formResourceModel,
         TransportBuilder $transportBuilder,
        StateInterface $state,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->formFactory = $formFactory;
        $this->formResourceModel = $formResourceModel;
        $this->storeManager = $storeManager;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $state;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }


    /**
     * Create product duplicate
     */
    public function execute()
    {
            
        $userData = $this->formFactory->create();
        $name = $this->getRequest()->getParam('customer_name');
        $email = $this->getRequest()->getParam('email');
        $comment = $this->getRequest()->getParam('comment');
        $url = $this->getRequest()->getParam('prd_url');
        $productName = $this->getRequest()->getParam('prd_name');
        $data = [
            'name' => $name,
            'email' => $email,
            'comment' => $comment,
            'url' => $url,
            'productName' => $productName,
        ];

        print_r($data);
        die();
       
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $template = $this->scopeConfig->getValue('popup/general/email_template', $storeScope);

        $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $this->storeManager->getStore()->getId());
        $templateVars = array(
                            'store' => $this->storeManager->getStore(),
                            'customer_name' => $name,
                            'comment'   => $comment,
                            'product_url' => $url,
                            'product_name' => $productName

                        );
        $from = array('email' => "test@example.com", 'name' => 'Name of Sender');
        $this->inlineTranslation->suspend();
        $to = array($email);
         
        $transport = $this->transportBuilder->setTemplateIdentifier($template, $storeScope)->setTemplateOptions($templateOptions)
                    ->setTemplateVars($templateVars)
                    ->setFrom($from)
                    ->addTo($to)
                    ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();

    }
}
