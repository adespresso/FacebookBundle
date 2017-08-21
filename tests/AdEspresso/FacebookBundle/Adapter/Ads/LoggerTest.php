<?php

namespace AdEspresso\FacebookBundle\Adapter\Ads;

use FacebookAds\Http\Headers;
use FacebookAds\Http\Parameters;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Http\ResponseInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

/**
 * @group unit
 */
class LoggerTest extends TestCase
{
    /**
     * @var PsrLoggerInterface
     */
    private $psrLogger;

    /**
     * @var Logger
     */
    protected $object;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->psrLogger = $this
            ->getMockBuilder(PsrLoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new Logger($this->psrLogger);
    }

    /**
     * @dataProvider logDataProvider
     */
    public function testLog($level)
    {
        $message = sha1(mt_rand());
        $context = range(1, 5);
        shuffle($context);

        $this->psrLogger
            ->expects($this->once())
            ->method('log')
            ->with(mb_strtolower($level), $message, $context);

        $this->psrLogger
            ->expects($this->never())
            ->method('debug');

        $this->object->log($level, $message, $context);
    }

    /**
     * @dataProvider logDataProvider
     */
    public function testLogFallback($level)
    {
        $message = sha1(mt_rand());
        $context = range(1, 5);
        shuffle($context);

        $this->psrLogger
            ->expects($this->never())
            ->method('log');

        $this->psrLogger
            ->expects($this->once())
            ->method('debug')
            ->with($message, [
                'level' => 's'.mb_strtolower($level),
                'context' => $context,
            ]);

        $this->object->log('s'.$level, $message, $context);
    }

    public static function logDataProvider()
    {
        return [
            'level' => ['error'],
            'case insensitive' => ['eRror'],
            'uppercase' => ['ERROR'],
            'fallback' => ['debug'],
        ];
    }

    public function testLogRequest()
    {
        $level = 'error';
        $context = range(1, 5);
        shuffle($context);

        $request = $this
            ->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn(new Headers());

        $request
            ->expects($this->once())
            ->method('getQueryParams')
            ->willReturn(new Parameters());

        $request
            ->expects($this->once())
            ->method('getBodyParams')
            ->willReturn(new Parameters());

        $request
            ->expects($this->once())
            ->method('getFileParams')
            ->willReturn(new Parameters());

        $request
            ->expects($this->once())
            ->method('getMethod')
            ->willReturn('GET');

        $request
            ->expects($this->once())
            ->method('getUrl')
            ->willReturn('http://www.example.com/');

        $request
            ->expects($this->once())
            ->method('getGraphVersion')
            ->willReturn('v2.0');

        $this->psrLogger
            ->expects($this->once())
            ->method('debug')
            ->with('GET http://www.example.com/', [
                'request' => [
                    'headers' => [],
                    'graph_version' => 'v2.0',
                    'query_params' => [],
                    'body_params' => [],
                    'file_params' => [],
                ],
                'context' => $context,
            ]);

        $this->object->logRequest($level, $request, $context);
    }

    public function testLogResponse()
    {
        $level = 'error';
        $content = sha1(mt_rand());
        $context = range(1, 5);
        shuffle($context);

        $response = $this
            ->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response
            ->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $response
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($content);

        $request = $this
            ->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response
            ->expects($this->once())
            ->method('getRequest')
            ->willReturn($request);

        $request
            ->expects($this->once())
            ->method('getHeaders')
            ->willReturn(new Headers());

        $request
            ->expects($this->once())
            ->method('getQueryParams')
            ->willReturn(new Parameters());

        $request
            ->expects($this->once())
            ->method('getBodyParams')
            ->willReturn(new Parameters());

        $request
            ->expects($this->once())
            ->method('getFileParams')
            ->willReturn(new Parameters());

        $request
            ->expects($this->once())
            ->method('getUrl')
            ->willReturn('http://www.example.com/');

        $request
            ->expects($this->once())
            ->method('getGraphVersion')
            ->willReturn('v2.0');

        $this->psrLogger
            ->expects($this->once())
            ->method('debug')
            ->with('200 http://www.example.com/', [
                'headers' => [],
                'graph_version' => 'v2.0',
                'query_params' => [],
                'body_params' => [],
                'file_params' => [],
                'content' => $content,
                'context' => $context,
            ]);

        $this->object->logResponse($level, $response, $context);
    }
}
