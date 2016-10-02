<?php

namespace AdEspresso\FacebookBundle\Adapter\Ads;

use FacebookAds\Http\RequestInterface;
use FacebookAds\Http\ResponseInterface;
use FacebookAds\Logger\LoggerInterface;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger as PsrNullLogger;

class Logger implements LoggerInterface
{
    /**
     * @var PsrLoggerInterface
     */
    private $psrLogger;

    /**
     * @param PsrLoggerInterface|null $psrLogger
     */
    public function __construct(PsrLoggerInterface $psrLogger = null)
    {
        $this->psrLogger = $psrLogger ?: new PsrNullLogger();
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = [])
    {
        if (defined(LogLevel::class.'::'.strtoupper($level))) {
            $this->psrLogger->log($level, $message, $context);

            return;
        }

        $this->psrLogger->debug($message, [
            'level' => $level,
            'context' => $context,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function logRequest(
        $level,
        RequestInterface $request,
        array $context = []
    ) {
        $this->psrLogger->debug(
            sprintf('%s %s', $request->getMethod(), $request->getUrl()),
            [
                'request' => [
                    'headers' => $request
                        ->getHeaders()
                        ->getArrayCopy(),
                    'graph_version' => $request->getGraphVersion(),
                    'query_params' => $request
                        ->getQueryParams()
                        ->export(),
                    'body_params' => $request
                        ->getBodyParams()
                        ->export(),
                    'file_params' => $request
                        ->getFileParams()
                        ->export(),
                ],
                'context' => $context,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function logResponse(
        $level,
        ResponseInterface $response,
        array $context = []
    ) {
        $request = $response->getRequest();

        $this->psrLogger->debug(
            sprintf(
                '%d %s',
                $response->getStatusCode(),
                $request->getUrl()
            ),
            [
                'headers' => $request
                    ->getHeaders()
                    ->getArrayCopy(),
                'graph_version' => $request->getGraphVersion(),
                'query_params' => $request
                    ->getQueryParams()
                    ->export(),
                'body_params' => $request
                    ->getBodyParams()
                    ->export(),
                'file_params' => $request
                    ->getFileParams()
                    ->export(),
                'content' => $response->getContent(),
                'context' => $context,
            ]
        );
    }
}
