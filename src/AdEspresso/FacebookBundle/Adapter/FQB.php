<?php

namespace AdEspresso\FacebookBundle\Adapter;

use Facebook\Facebook;
use SammyK\FacebookQueryBuilder\FQB as BaseFQB;

class FQB extends BaseFQB
{
    /**
     * @var Facebook
     */
    private $facebook;

    /**
     * @param Facebook $facebook
     * @param string   $graphEndpoint
     */
    public function __construct(Facebook $facebook, $graphEndpoint = '')
    {
        $this->facebook = $facebook;

        parent::__construct([], $graphEndpoint);
    }

    /**
     * {@inheritdoc}
     */
    public function node($graphNodeName)
    {
        return new self($this->facebook, $graphNodeName);
    }

    /**
     * Sends a GET request to Graph and returns the result.
     *
     * @param \Facebook\Authentication\AccessToken|string|null $accessToken
     * @param string|null                                      $eTag
     * @param string|null                                      $graphVersion
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     *
     * @return \Facebook\FacebookResponse
     */
    public function get($accessToken = null, $eTag = null, $graphVersion = null)
    {
        return $this->facebook->sendRequest(
            'GET',
            $this->asEndpoint(),
            [],
            $accessToken,
            $eTag,
            $graphVersion
        );
    }
}
