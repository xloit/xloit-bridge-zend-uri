<?php
/**
 * This source file is part of Xloit project.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License that is bundled with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * <http://www.opensource.org/licenses/mit-license.php>
 * If you did not receive a copy of the license and are unable to obtain it through the world-wide-web,
 * please send an email to <license@xloit.com> so we can send you a copy immediately.
 *
 * @license   MIT
 * @link      http://xloit.com
 * @copyright Copyright (c) 2016, Xloit. All rights reserved.
 */

namespace Xloit\Bridge\Zend\Uri;

use Zend\Uri\Uri;

/**
 * A {@link BrowserSupport} class that only accept the list of browser schemes.
 *
 * @package Xloit\Bridge\Zend\Uri
 */
class BrowserSupport extends Uri
{
    /**
     *
     * @static
     *
     * @var array
     */
    protected static $validSchemes = [
        'chrome-extension'
    ];

    /**
     * Check if the URI is a valid File URI.
     * This applies additional specific validation rules beyond the ones required by the generic URI syntax.
     *
     * @see Uri::isValid().
     *
     * @return bool
     */
    public function isValid()
    {
        if ($this->query) {
            return false;
        }

        return parent::isValid();
    }

    /**
     * User Info part is not used in browser support URIs.
     *
     * @see Uri::setUserInfo()
     *
     * @param string $userInfo
     *
     * @return $this
     */
    public function setUserInfo($userInfo)
    {
        // Keep silent
        return $this;
    }

    /**
     * Fragment part is not used in browser support URIs.
     *
     * @see Uri::setFragment()
     *
     * @param string $fragment
     *
     * @return $this
     */
    public function setFragment($fragment)
    {
        // Keep silent
        return $this;
    }

    /**
     * Add more scheme to the lists.
     *
     * @param string $scheme
     *
     * @return void
     */
    public static function addValidScheme($scheme)
    {
        static::$validSchemes[] = $scheme;
    }
}
