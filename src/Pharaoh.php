<?php declare(strict_types=1);

/*
 * This file is part of Pharaoh.
 *
 * (c) Steve Buzonas <steve@fancyguy.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pharaoh;

use Pharaoh\Config\ConfigInterface;

class Pharaoh
{
    protected $booted = false;
    private $profile;
    private $startTime;
    private $container;
    private $config;
    private $name;

    public function __construct(ConfigInterface $config, string $name, bool $profile = false)
    {
        $this->config  = $config;
        $this->name    = $name;
        $this->profile = $profile;

        if ($this->profile) {
            $this->startTime = microtime(true);
        }
    }

    public function __clone()
    {
        $this->booted    = false;
        $this->container = null;

        if ($this->profile) {
            $this->startTime = microtime(true);
        }
    }

    /**
     * Checks if the profiler is enabled.
     *
     * @return bool true if profiler is enabled, false otherwise
     */
    public function isProfilerEnabled(): bool
    {
        return $this->profile;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigDirectory(): string
    {
        return $this->config->getConfigDirectory();
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDirectory(): string
    {
        return $this->config->getCacheDirectory();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDirectory(): string
    {
        return $this->config->getLogDirectory();
    }

    /**
     * Gets the request start time.
     *
     * @return float The application start timestamp (-INF is profiler is disabled)
     */
    public function getStartTime(): float
    {
        return $this->profile ? $this->startTime : -INF;
    }
}
