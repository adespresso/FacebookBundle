<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use Facebook\Http\GraphRawResponse;
use Symfony\Component\EventDispatcher\Event;

class HttpClientPostSendEvent extends Event
{
    /**
     * @var GraphRawResponse
     */
    private $graphRawResponse;

    /**
     * @param GraphRawResponse $graphRawResponse
     */
    public function __construct(GraphRawResponse $graphRawResponse)
    {
        $this->graphRawResponse = $graphRawResponse;
    }

    /**
     * Gets the value of graphRawResponse.
     *
     * @return GraphRawResponse
     */
    public function getGraphRawResponse()
    {
        return $this->graphRawResponse;
    }

    /**
     * Sets the value of graphRawResponse.
     *
     * @param GraphRawResponse $graphRawResponse
     */
    public function setGraphRawResponse(GraphRawResponse $graphRawResponse)
    {
        $this->graphRawResponse = $graphRawResponse;
    }
}
