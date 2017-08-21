<?php

namespace AdEspresso\FacebookBundle\Event\Ads;

use FacebookAds\Http\Adapter\AdapterInterface;
use FacebookAds\Http\ResponseInterface;
use Symfony\Component\EventDispatcher\Event;

class HttpResponseEvent extends Event
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * @param ResponseInterface $response
     * @param AdapterInterface  $adapter
     */
    public function __construct(
        ResponseInterface $response,
        AdapterInterface $adapter
    ) {
        $this->response = $response;
        $this->adapter = $adapter;
    }

    /**
     * Gets the HTTP response.
     *
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the HTTP response.
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Gets the adapter.
     *
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
