<?php

declare(strict_types = 1);

namespace ArangoDBClient\Tests\EndToEnd;

use ArangoDBClient\Connection;
use ArangoDBClient\ConnectionOptions;
use ArangoDBClient\UpdatePolicy;
use PHPUnit\Framework\TestCase;

/**
 * @property \ArangoDBClient\AdminHandler $adminHandler
 */
class TestBase extends TestCase
{
    protected string $fixturesDir = './tests/fixtures';

    protected function isEnterprise(): bool
    {
        $version = $this->adminHandler->getServerVersion(true);

        return $version['details']['enterprise-version'] ?? '' === 'enterprise';
    }

    protected function isCluster(): bool
    {
        try {
            $role = $this->adminHandler->getServerRole();

            return $role === 'COORDINATOR' || $role === 'DBSERVER';
        } catch (\Exception $e) {
            // maybe server version is too "old"
            return false;
        }
    }

    protected function useAuthentication(): bool
    {
        $authentication = getenv("ARANGO_USE_AUTHENTICATION");

        if ($authentication === false) {
            // use ArangoDB default value
            return true;
        }

        $authentication = strtolower($authentication);

        return $authentication === '1'
            || $authentication === 'true'
            || $authentication === 'on'
            || $authentication === 'yes'
            || $authentication === 'enabled';
    }

    protected function createConnection(): Connection
    {
        return new Connection($this->getConnectionOptions());
    }

    protected function getConnectionOptions(): array
    {
        return array_merge(
            $this->getConnectionOptionsGlobal(),
            $this->getConnectionOptionsOverrides(),
        );
    }

    protected function getConnectionOptionsGlobal(): array
    {
        $host = getenv('ARANGO_HOST');
        if ($host === false) {
            $host = 'localhost';
        }

        $port = getenv('ARANGO_PORT');
        if ($port === false) {
            $port = '8529';
        }

        $authPasswd = getenv('ARANGO_ROOT_PASSWORD');
        if ($authPasswd === false) {
            $authPasswd = '';
        }

        return [
            ConnectionOptions::OPTION_ENDPOINT           => 'tcp://' . $host . ':' . $port,
            ConnectionOptions::OPTION_AUTH_TYPE          => 'Basic',
            ConnectionOptions::OPTION_AUTH_USER          => 'root',
            ConnectionOptions::OPTION_AUTH_PASSWD        => $authPasswd,
            ConnectionOptions::OPTION_TIMEOUT            => 60,
            ConnectionOptions::OPTION_CREATE             => false,
            ConnectionOptions::OPTION_UPDATE_POLICY      => UpdatePolicy::LAST,
            ConnectionOptions::OPTION_CHECK_UTF8_CONFORM => true,
        ];
    }

    protected function getConnectionOptionsOverrides(): array
    {
        $options = [];
        $envVars = getenv();
        $prefix = 'ARANGODB_CONNECTION_';
        $prefixLength = strlen($prefix);
        foreach ($envVars as $name => $value) {
            if (strpos($name, $prefix) !== 0) {
                continue;
            }

            $options[substr($name, $prefixLength)] = $value;
        }

        $traceCallback = $this->getTraceCallback();
        if ($traceCallback !== null) {
            $options[ConnectionOptions::OPTION_TRACE] = $traceCallback;
        }

        return $options;
    }

    protected function getTraceCallback(): ?\Closure
    {
        return null;
    }
}
