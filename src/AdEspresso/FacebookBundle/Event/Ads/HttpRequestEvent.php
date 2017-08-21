<?php

namespace AdEspresso\FacebookBundle\Event\Ads;

use FacebookAds\Http\Adapter\AdapterInterface;
use FacebookAds\Http\RequestInterface;
use Symfony\Component\EventDispatcher\Event;

class HttpRequestEvent extends Event
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * @param RequestInterface $request
     * @param AdapterInterface $adapter
     */
    public function __construct(
        RequestInterface $request,
        AdapterInterface $adapter
    ) {
        $this->request = $request;
        $this->adapter = $adapter;
    }

    /**
     * Gets the HTTP request.
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the HTTP request.
     *
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
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
