<?php

namespace Address\Configuration
{

    use Address\Exceptions\ConfigurationException;

    /**
     * @covers Address\Configuration\Configuration
     */
    class ConfigurationTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Configuration */
        private $configuration;

        protected function setUp()
        {
            $this->configuration = new Configuration(__DIR__ . '/../../conf/config.php');
        }

        /**
         * @dataProvider provideTestData
         * @param $method
         * @param $result
         */
        public function testConfigurationEntriesCanBeRetrieved($method, $result)
        {
            $this->assertEquals($result, call_user_func_array([$this->configuration, $method], []));
        }

        public function provideTestData()
        {
            $basePath = '/var/www/CPCII/Address/conf/../';

            return [
                ['isProduction', false],
                ['getErrorLogPath', $basePath . '/logs/error.log'],
                ['getTwigTemplatePath', $basePath . '/resources/views'],
                ['getDatabaseHost', 'localhost'],
                ['getDatabaseName', 'Cart'],
                ['getDatabaseUser', 'addressUser'],
                ['getDatabasePassword', 'addressApp'],
                ['getDatabaseCharset', 'utf8'],
            ];
        }

        public function testGetValueFromConfigThrowsExceptionIfValueNotFound()
        {
            $this->expectException(ConfigurationException::class);
            $this->configuration->getValueFromConfig('invalidKey');
        }

        public function testLoadConfigThrowsExceptionIfFileIsNotReadable()
        {
            $unreadableFile = new Configuration(__DIR__ . '/../../conf/notExistingFile.php');
            $this->expectException(ConfigurationException::class);
            $unreadableFile->getValueFromConfig('production');
        }
    }
}
