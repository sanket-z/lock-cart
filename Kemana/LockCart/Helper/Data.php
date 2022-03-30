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
namespace Kemana\LockCart\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     */
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    public function lockQuote($quoteId, int $customData)
    {
        $quote = $this->quoteRepository->get($quoteId);
        $quote->setData('is_locked', $customData);
        $this->quoteRepository->save($quote);
    }
}
