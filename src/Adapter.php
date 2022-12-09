<?php

namespace Fusio\Adapter\OAuth2;

use Fusio\Engine\AdapterInterface;

/**
 * Adapter
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    https://www.fusio-project.org/
 */
class Adapter implements AdapterInterface
{
    public function getDefinition(): string
    {
        return __DIR__ . '/../definition.json';
    }
}