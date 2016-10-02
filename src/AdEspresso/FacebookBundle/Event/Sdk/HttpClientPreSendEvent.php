<?php

namespace AdEspresso\FacebookBundle\Event\Sdk;

use Symfony\Component\EventDispatcher\Event;

class HttpClientPreSendEvent extends Event
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var int
     */
    private $timeOut;

    /**
     * @param string $url
     * @param string $method
     * @param string $body
     * @param array  $headers
     * @param int    $timeOut
     */
    public function __construct($url, $method, $body, array $headers, $timeOut)
    {
        $this->url = $url;
        $this->method = $method;
        $this->body = $body;
        $this->headers = $headers;
        $this->timeOut = $timeOut;
    }

    /**
     * Gets the value of url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the value of url.
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Gets the value of method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Sets the value of method.
     *
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Gets the value of body.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Sets the value of body.
     *
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Gets the value of headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Sets the value of headers.
     *
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Gets the value of timeOut.
     *
     * @return int
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * Sets the value of timeOut.
     *
     * @param int $timeOut
     */
    public function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;
    }
}
