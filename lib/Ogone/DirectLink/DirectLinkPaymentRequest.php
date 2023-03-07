<?php
/*
 * This file is part of the Marlon Ogone package.
 *
 * (c) Marlon BVBA <info@marlon.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ogone\DirectLink;

use Ogone\AbstractPaymentRequest;
use Ogone\ShaComposer\ShaComposer;
use InvalidArgumentException;

class DirectLinkPaymentRequest extends AbstractPaymentRequest
{

    const TEST = "https://secure.ogone.com/ncol/test/orderdirect_utf8.asp";
    const PRODUCTION = "https://secure.ogone.com/ncol/prod/orderdirect_utf8.asp";

    public function __construct(ShaComposer $shaComposer)
    {
        $this->shaComposer = $shaComposer;
        $this->ogoneUri = self::TEST;
    }

    public function getRequiredFields(): array
    {
        return ['pspid', 'currency', 'amount', 'orderid', 'userid', 'pswd'];
    }

    /**
     * Set User ID.
     *
     * @param $userid
     * @return $this
     */
    public function setUserId($userid): static
    {
        if (strlen((string) $userid) < 2) {
            throw new InvalidArgumentException("User ID is too short");
        }
        $this->parameters['userid'] = $userid;

        return $this;
    }

    /**
     * Alias for setPswd().
     *
     * @param $password
     * @return $this
     */
    public function setPassword($password): static
    {
        return $this->setPswd($password);
    }

    /**
     * Set Password.
     *
     * @param $password
     * @return $this
     */
    public function setPswd($password): static
    {
        if (strlen((string) $password) < 8) {
            throw new InvalidArgumentException("Password is too short");
        }
        $this->parameters['pswd'] = $password;

        return $this;
    }

    /**
     * Set Alias.
     *
     * @return $this
     */
    public function setAlias(Alias $alias): static
    {
        $this->parameters['alias'] = $alias->getAlias();
        $this->parameters['aliasOperation'] = $alias->getAliasOperation();

        return $this;
    }

    /**
     * Set ECI.
     *
     * @return $this
     */
    public function setEci(Eci $eci): static
    {
        $this->parameters['eci'] = (string) $eci;

        return $this;
    }

    /**
     * Set CVC.
     *
     * @param $cvc
     * @return $this
     */
    public function setCvc($cvc): static
    {
        $this->parameters['cvc'] = $cvc;

        return $this;
    }

    /**
     * Set CreditDebit Flag.
     *
     * @param $creditDebit
     * @return $this
     */
    public function setCreditDebit($creditDebit): static
    {
        $this->parameters['creditdebit'] = $creditDebit;

        return $this;
    }

    protected function getValidOperations(): array
    {
        return [PaymentOperation::REQUEST_FOR_AUTHORISATION, PaymentOperation::REQUEST_FOR_DIRECT_SALE, PaymentOperation::REFUND, PaymentOperation::REQUEST_FOR_PRE_AUTHORISATION];
    }
}
