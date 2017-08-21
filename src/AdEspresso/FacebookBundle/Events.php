<?php

namespace AdEspresso\FacebookBundle;

/**
 * Bundle events.
 */
final class Events
{
    /**
     * Event that occurs before an Ads request is sent.
     *
     * @var string
     */
    const ADS_HTTP_REQUEST = 'facebook_ads.http.request';

    /**
     * Event that occurs after an Ads response is sent.
     *
     * @var string
     */
    const ADS_HTTP_RESPONSE = 'facebook_ads.http.response';

    /**
     * Event that occurs before a HTTP request is sent with the SDK.
     *
     * @var string
     */
    const SDK_HTTP_CLIENT_PRE_SEND = 'facebook_sdk.http_client.pre_send';

    /**
     * Event that occurs after a HTTP request is sent with the SDK.
     *
     * @var string
     */
    const SDK_HTTP_CLIENT_POST_SEND = 'facebook_sdk.http_client.post_send';
}
