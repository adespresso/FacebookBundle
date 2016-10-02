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
     * Gets the value of request.
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the value of request.
     *
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
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
