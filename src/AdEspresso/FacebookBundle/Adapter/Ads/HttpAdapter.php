<?php

namespace AdEspresso\FacebookBundle\Adapter\Ads;

use AdEspresso\FacebookBundle\Event\Ads\HttpRequestEvent;
use AdEspresso\FacebookBundle\Event\Ads\HttpResponseEvent;
use AdEspresso\FacebookBundle\Events;
use ArrayObject;
use FacebookAds\Http\Adapter\AbstractAdapter;
use FacebookAds\Http\Client;
use FacebookAds\Http\Headers;
use FacebookAds\Http\RequestInterface;
use FacebookAds\Http\Response;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class HttpAdapter extends AbstractAdapter
{
    /**
     * Guzzle 6 client.
     *
     * @var GuzzleClientInterface
     */
    private $guzzleClient;

    /**
     * Events dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * Request options.
     *
     * @var ArrayObject|null
     */
    private $opts;

    /**
     * {@inheritdoc}
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);

        $this->setEventDispatcher(new EventDispatcher());
        $this->setGuzzleClient(new GuzzleClient());
        $this->setOpts(new ArrayObject());
    }

    /**
     * {@inheritdoc}
     */
    public function getOpts()
    {
        return $this->opts;
    }

    /**
     * {@inheritdoc}
     */
    public function setOpts(ArrayObject $opts)
    {
        $this->opts = $opts;
    }
    /**
     * {@inheritdoc}
     */
    public function sendRequest(RequestInterface $request)
    {
        $requestEvent = new HttpRequestEvent($request, $this);
        $this->eventDispatcher->dispatch(
            Events::ADS_HTTP_REQUEST,
            $requestEvent
        );
        $request = $requestEvent->getRequest();

        $curlOptions = $this->getOpts()->getArrayCopy();

        $postfields = [];
        if (
            'POST' === $request->getMethod() &&
            $request->getFileParams()->count()
        ) {
            $postfields = array_merge(
                $postfields,
                array_map(
                    function ($filepath) {
                        return '@'.$filepath;
                    },
                    $request->getFileParams()->getArrayCopy()
                )
            );
        }
        if (
            'GET' !== $request->getMethod() &&
            $request->getBodyParams()->count()
        ) {
            $postfields = array_merge(
                $postfields,
                $request->getBodyParams()->export()
            );
        }

        if (!empty($postfields)) {
            $curlOptions[CURLOPT_POSTFIELDS] = $postfields;
        }

        $psrResponse = $this->guzzleClient->request(
            $request->getMethod(),
            $request->getUrl(),
            [
                'headers' => $request
                    ->getHeaders()
                    ->getArrayCopy(),
                'curl' => $curlOptions,
            ]
        );

        $response = new Response();
        $response->setRequest($request);
        $response->setStatusCode($psrResponse->getStatusCode());
        $response->setBody((string) $psrResponse->getBody());

        $headers = new Headers();
        foreach ($psrResponse->getHeaders() as $name => $values) {
            $headers[$name] = implode(', ', $values);
        }

        $response->setHeaders($headers);

        $responseEvent = new HttpResponseEvent($response, $this);
        $this->eventDispatcher->dispatch(
            Events::ADS_HTTP_RESPONSE,
            $responseEvent
        );

        return $responseEvent->getResponse();
    }

    /**
     * Sets the Guzzle 6 client.
     *
     * @param GuzzleClientInterface $guzzleClient
     */
    public function setGuzzleClient(GuzzleClientInterface $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
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
}
