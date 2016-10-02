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
     * Gets the value of response.
     *
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the value of response.
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Gets the value of adapter.
     *
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
