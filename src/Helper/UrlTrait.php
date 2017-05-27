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

namespace Xloit\Bridge\Zend\Uri\Helper;

use Xloit\Bridge\Zend\Uri\Exception;

/**
 * An {@link UrlTrait} trait.
 *
 * @package Xloit\Bridge\Zend\Uri\Helper
 */
trait UrlTrait
{
    /**
     * Generates a URL based on a route.
     *
     * @param string $route
     *
     * @return string|bool The generated URL or false on failure.
     * @throws \Xloit\Bridge\Zend\Uri\Exception\RuntimeException
     */
    protected function generateRouteUrl($route = null)
    {
        if (null === $route || strpos($route, '/') !== 0) {
            return $route;
        }

        if (null === $this->getRouteMatch()) {
            throw new Exception\RuntimeException('No RouteMatch instance provided');
        }

        $routeName = $this->getRouteMatch()->getMatchedRouteName();

        if ($routeName === null) {
            throw new Exception\RuntimeException('RouteMatch does not contain a matched route name');
        }

        $position = strpos($routeName, '/');

        if ($position !== false) {
            /**
             * If we request the name /, it will mean that we need to only get
             * the root part of the route without any other module route params
             */
            if ('/' === $route) {
                $results = substr($routeName, 0, $position);
            } else {
                $results = substr($routeName, 0, $position) . $route;
            }
        } else {
            if ('/' === $route) {
                $results = $routeName;
            } else {
                $results = $routeName . $route;
            }
        }

        return $results;
    }

    /**
     * Generates a URL based on a route.
     *
     * @return \Zend\Router\RouteMatch
     */
    abstract public function getRouteMatch();
}
