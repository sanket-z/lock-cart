<?php
/**
 * Copyright © 2022 PT Kemana Teknologi Solusi. All rights reserved.
 * http://www.kemana.com
 */

/**
 * @category Kemana
 * @package  Kemana_LockCart
 * @license  Proprietary
 *
 * @author   Sanket Zadafiya <szadafiya@kemana.com>
 */
namespace Kemana\LockCart\Observer;

use Magento\Framework\Event\ObserverInterface;

class RestrictAddToCart implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    protected $checkoutSession;

    /**
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Checkout\Model\SessionFactory $checkoutSession
    ) {
        $this->messageManager  = $messageManager;
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * add to cart event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     *
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $this->checkoutSession->create()->getQuote();

        if (!empty($quote)) {
            $isLockedCart = $quote->getData('is_locked');

            if (!empty($isLockedCart)) {
                $this->messageManager->addError(__('Cart has been locked'));
                $observer->getRequest()->setParam('product', false);
                return $this;
            }
        }
        return $this;
    }
}
