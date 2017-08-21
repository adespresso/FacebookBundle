<?php

namespace AdEspresso\FacebookBundle\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getContainerExtension()
    {
        return new FacebookExtension();
    }

    protected function getConfiguration()
    {
        return new Configuration();
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalid($configuration)
    {
        $this->assertConfigurationIsInvalid($configuration);
    }

    public static function invalidDataProvider()
    {
        foreach (glob(__DIR__.'/Fixtures/invalid/*.php') as $file) {
            yield basename($file, '.php') => [require_once $file];
        }
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testValid($configuration)
    {
        $this->assertConfigurationIsValid($configuration);
    }

    public static function validDataProvider()
    {
        foreach (glob(__DIR__.'/Fixtures/valid/*.php') as $file) {
            yield basename($file, '.php') => [require_once $file];
        }
    }
}
