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

use Ogone\AbstractRequest;
use Ogone\ShaComposer\ShaComposer;

class CreateAliasRequest extends AbstractRequest
{

    final public const TEST = "https://secure.ogone.com/ncol/test/alias_gateway_utf8.asp";
    final public const PRODUCTION = "https://secure.ogone.com/ncol/prod/alias_gateway_utf8.asp";

    public function __construct(ShaComposer $shaComposer)
    {
        $this->shaComposer = $shaComposer;
        $this->ogoneUri = self::TEST;
    }

    public function getRequiredFields()
    {
        return ['pspid', 'accepturl', 'exceptionurl'];
    }

    public function setAlias(Alias $alias)
    {
        $this->parameters['alias'] = (string) $alias;
    }
}
