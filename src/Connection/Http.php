<?php

namespace Fusio\Adapter\OAuth2\Connection;

use Fusio\Engine\ConnectionInterface;
use Fusio\Engine\Form\BuilderInterface;
use Fusio\Engine\Form\ElementFactoryInterface;
use Fusio\Engine\ParametersInterface;
use GuzzleHttp;

/**
 * Http
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    https://www.fusio-project.org/
 */
class Http implements ConnectionInterface
{
    public function getName(): string
    {
        return 'HTTP (OAuth2)';
    }

    public function getConnection(ParametersInterface $config): GuzzleHttp\Client
    {
        $options = [];

        $baseUri = $config->get('url');
        if (!empty($baseUri)) {
            $options['base_uri'] = $config->get('url');
        }

        $username = $config->get('username');
        $password = $config->get('password');
        if (!empty($username) && !empty($password)) {
            $options['auth'] = [$username, $password];
        }

        $proxy = $config->get('proxy');
        if (!empty($proxy)) {
            $options['proxy'] = $proxy;
        }

        $options['http_errors'] = false;

        return new GuzzleHttp\Client($options);
    }

    public function configure(BuilderInterface $builder, ElementFactoryInterface $elementFactory): void
    {
        $builder->add($elementFactory->newInput('url', 'Url', 'text', 'HTTP base url'));
        $builder->add($elementFactory->newInput('username', 'Username', 'text', 'Optional username for authentication'));
        $builder->add($elementFactory->newInput('password', 'Password', 'text', 'Optional password for authentication'));
        $builder->add($elementFactory->newInput('proxy', 'Proxy', 'text', 'Optional HTTP proxy'));
    }
}