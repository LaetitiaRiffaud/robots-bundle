<?php

/*
 * This file is part of the robots-bundle package.
 *
 * (c) Christian Daguerre <christian@daguer.re>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Dag\Component\Robots\Model;

use Sylius\Component\Resource\Model\TimestampableInterface;

/**
 * @author Christian Daguerre <christian@daguer.re>
 */
interface RuleInterface extends TimestampableInterface
{
    /**
     * Get route.
     *
     * @return string
     */
    public function getRoute();

    /**
     * Set route.
     *
     * @param string $route
     */
    public function setRoute($route);

    /**
     * Get host.
     *
     * @return string
     */
    public function getHost();

    /**
     * Set host.
     *
     * @param string $host
     */
    public function setHost($host);

    /**
     * Get tags.
     *
     * @return array
     */
    public function getTags();

    /**
     * Set tags.
     *
     * @param string $tags
     */
    public function setTags(array $tags);
}
