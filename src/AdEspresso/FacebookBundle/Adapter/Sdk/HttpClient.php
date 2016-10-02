<?php

namespace AdEspresso\FacebookBundle\Adapter\Sdk;

use AdEspresso\FacebookBundle\Event\Sdk\HttpClientPostSendEvent;
use AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent;
use AdEspresso\FacebookBundle\Events;
use Facebook\Http\GraphRawResponse;
use Facebook\HttpClients\FacebookHttpClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class HttpClient implements FacebookHttpClientInterface
{
    /**
     * Guzzle 6 client.
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
     * Sets the Guzzle 6 client.
     *
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
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
     * {@inheritdoc}
     */
    public function send($url, $method, $body, array $headers, $timeOut)
    {
        $preSendEvent = new HttpClientPreSendEvent($request, $this);
        $this->eventDispatcher->dispatch(
            Events::SDK_HTTP_CLIENT_PRE_SEND,
            $preSendEvent
        );

        $url = $preSendEvent->getUrl();
        $method = $preSendEvent->getMethod();
        $body = $preSendEvent->getBody();
        $headers = $preSendEvent->getHeaders();
        $timeOut = $preSendEvent->getTimeOut();

        $response = $this->client->request($method, $url, [
            'body' => $body,
            'headers' => $headers,
        ]);

        $headers = [];
        foreach ($response->getHeaders() as $name => $values) {
            $headers[$name] = implode(', ', $values);
        }

        $graphRawResponse = new GraphRawResponse(
            $headers,
            (string) $response->getBody(),
            $response->getStatusCode()
        );

        $postSendEvent = new HttpClientPostSendEvent($graphRawResponse);
        $this->eventDispatcher->dispatch(
            Events::SDK_HTTP_CLIENT_POST_SEND,
            $postSendEvent
        );

        return $postSendEvent->getGraphRawResponse();
    }
}
