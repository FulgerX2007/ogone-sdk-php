<?php
/*
 * @author Nicolas Clavaud <nicolas@lrqdo.fr>
 */

namespace Ogone\DirectLink;

use Ogone\AbstractDirectLinkRequest;
use Ogone\ShaComposer\ShaComposer;

class DirectLinkQueryRequest extends AbstractDirectLinkRequest
{

    final public const TEST = "https://secure.ogone.com/ncol/test/querydirect_utf8.asp";
    final public const PRODUCTION = "https://secure.ogone.com/ncol/prod/querydirect_utf8.asp";

    public function __construct(ShaComposer $shaComposer)
    {
        $this->shaComposer = $shaComposer;
        $this->ogoneUri = self::TEST;
    }

    public function setPayIdSub($payidsub)
    {
        $this->parameters['payidsub'] = $payidsub;
    }

    public function getRequiredFields()
    {
        return ['pspid', 'userid', 'pswd'];
    }

    public function validate()
    {
        parent::validate();

        foreach ($this->getRequiredFieldGroups() as $group) {
            $empty = true;

            foreach ($group as $field) {
                if (!empty($this->parameters[$field])) {
                    $empty = false;
                    break;
                }
            }

            if ($empty) {
                throw new \RuntimeException(
                    sprintf("At least one of these fields should not be empty: %s", implode(', ', $group))
                );
            }
        }
    }
}
