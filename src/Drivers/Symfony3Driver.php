<?php

namespace SourceBroker\DeployerExtendedSymfony3\Drivers;

use \Symfony\Component\Yaml\Yaml;

/**
 * Class Symfony3Driver
 * @package SourceBroker\DeployerExtended\Drivers
 */
class Symfony3Driver
{
    /**
     * @param null $absolutePathWithConfig
     * @return array
     * @throws \Exception
     */
    public function getDatabaseConfig($absolutePathWithConfig = null)
    {
        if (null == $absolutePathWithConfig) {
            $absolutePathWithConfig = __DIR__ . '/../../../../../app/config/parameters.yml';
        }
        if (file_exists($absolutePathWithConfig)) {
            if (!class_exists(\Symfony\Component\Yaml\Yaml::class)) {
                throw new \Exception('Unable to read yaml as the Symfony Yaml Component is not installed.');
            } else {
                $dbConfig = null;
                $config = Yaml::parse(file_get_contents($absolutePathWithConfig));
                $dbConfig = [
                    'driver' => 'pdo_mysql',
                    'host' => '127.0.0.1',
                    'dbname' => '',
                    'user' => '',
                    'password' => '',
                    'charset' => 'utf8',
                ];
                if (!empty($config['parameters']['database_host'])) {
                    $dbConfig['host'] = $config['parameters']['database_host'];
                }
                if (!empty($config['parameters']['database_name'])) {
                    $dbConfig['dbname'] = $config['parameters']['database_name'];
                } else {
                    throw new \Exception('Unable to read database_name in file: "' . $absolutePathWithConfig . '"');
                }
                if (!empty($config['parameters']['database_user'])) {
                    $dbConfig['user'] = $config['parameters']['database_user'];
                } else {
                    throw new \Exception('Unable to read database_user in file: "' . $absolutePathWithConfig . '"');
                }
                if (!empty($config['parameters']['database_password'])) {
                    $dbConfig['password'] = $config['parameters']['database_password'];
                } else {
                    throw new \Exception('Unable to read database_password in file: "' . $absolutePathWithConfig . '"');
                }
                if (!empty($config['parameters']['database_port']) && $config['parameters']['database_port']) {
                    $dbConfig['port'] = $config['parameters']['database_port'];
                }
                return $dbConfig;
            }
        } else {
            throw new \Exception('Missing file with database parameters. Looking for file: "' . $absolutePathWithConfig . '"');
        }

    }

    /**
     * @param null $absolutePathWithConfig
     * @return string
     * @throws \Exception
     */
    public function getInstanceName($absolutePathWithConfig = null)
    {
        if (null == $absolutePathWithConfig) {
            $absolutePathWithConfig = __DIR__ . '/../../../../../app/config/parameters.yml';
        }
        if (file_exists($absolutePathWithConfig)) {
            if (!class_exists(\Symfony\Component\Yaml\Yaml::class)) {
                throw new \RuntimeException('Unable to read yaml as the Symfony Yaml Component is not installed.');
            } else {
                $instanceName = null;
                /** @noinspection PhpIncludeInspection */
                $config = Yaml::parse(file_get_contents($absolutePathWithConfig));
                $instanceName = null;
                if (!empty($config['parameters']['instance'])) {
                    $instanceName = $config['parameters']['instance'];
                } else {
                    throw new \Exception('Missing "instance" parameter in file: "' . $absolutePathWithConfig . '"');
                }
                return $instanceName;
            }
        } else {
            throw new \Exception('Missing file with instance name. Looking for file: "' . $absolutePathWithConfig . '"');
        }
    }
}