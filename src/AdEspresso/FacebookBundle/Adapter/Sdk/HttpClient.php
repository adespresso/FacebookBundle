<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use AdEspresso\FacebookBundle\Event\Sdk\HttpClientPostSendEvent;
use AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent;
use AdEspresso\FacebookBundle\Events;
use Facebook\Http\GraphRawResponse;
use Facebook\HttpClients\FacebookHttpClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class HttpClient implements FacebookHttpClientInterface
{
    /**
     * Guzzle 6 HTTP client.
     *
     * @var ClientInterface
     */
    private $client;

    /**
     * Events dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * Initialize attributes.
     */
    public function __construct()
    {
        $this->setClient(new Client());
        $this->setEventDispatcher(new EventDispatcher());
    }

    /**
     * Sets the Guzzle 6 HTTP client.
     *
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Gets the Guzzle 6 HTTP client.
     *
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Sets the events dispatcher.
     *
     * @param EventDispatcherInterface $dispatcher
     */
    public function setEventDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->eventDispatcher = $dispatcher;
    }

    /**
     * Gets the events dispatcher.
     *
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function send($url, $method, $body, array $headers, $timeOut)
    {
        $preSendEvent = new HttpClientPreSendEvent(...func_get_args());
        $this->eventDispatcher->dispatch(
            Events::SDK_HTTP_CLIENT_PRE_SEND,
            $preSendEvent
        );

        $response = $this->sendRequest($preSendEvent);
        $graphRawResponse = $this->getGraphRawResponse($response);

        $postSendEvent = new HttpClientPostSendEvent($graphRawResponse);
        $this->eventDispatcher->dispatch(
            Events::SDK_HTTP_CLIENT_POST_SEND,
            $postSendEvent
        );

        return $postSendEvent->getGraphRawResponse();
    }

    /**
     * Sends the HTTP request.
     *
     * @param HttpClientPreSendEvent $event
     *
     * @return ResponseInterface
     */
    private function sendRequest(HttpClientPreSendEvent $event)
    {
        return $this->client->request(
            $event->getMethod(),
            $event->getUrl(),
            [
                'body' => $event->getBody(),
                'headers' => $event->getHeaders(),
                'http_errors' => false,
                'timeout' => $event->getTimeOut(),
            ]
        );
    }

    /**
     * Gets the graph raw response.
     *
     * @param ResponseInterface $response
     *
     * @return GraphRawResponse
     */
    private function getGraphRawResponse(ResponseInterface $response)
    {
        $headers = [];
        foreach ($response->getHeaders() as $name => $values) {
            $headers[$name] = implode(', ', $values);
        }

        return new GraphRawResponse(
            $headers,
            (string) $response->getBody(),
            $response->getStatusCode()
        );
    }
}
