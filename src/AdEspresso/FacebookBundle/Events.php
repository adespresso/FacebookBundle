<?php

namespace AdEspresso\FacebookBundle;

/**
 * Bundle events.
 */
final class Events
{
    /**
     * Event that occurs before an Ads request is given.
     *
     * @var string
     */
    const ADS_HTTP_REQUEST = 'facebook_ads.http.request';

    /**
     * Event that occurs after an Ads response is given.
     *
     * @var string
     */
    const ADS_HTTP_RESPONSE = 'facebook_ads.http.response';

    /**
     * @var string
     */
    const SDK_HTTP_CLIENT_PRE_SEND = 'facebook_sdk.http_client.pre_send';

    /**
     * @var string
     */
    const SDK_HTTP_CLIENT_POST_SEND = 'facebook_sdk.http_client.post_send';

    /**
     * @var string
     */
    const SDK_PERSISTENT_DATA_PRE_GET = 'facebook_sdk.persistent_data.pre_get';

    /**
     * @var string
     */
    const SDK_PERSISTENT_DATA_POST_GET = 'facebook_sdk.persistent_data.post_get';

    /**
     * @var string
     */
    const SDK_PERSISTENT_DATA_PRE_SET = 'facebook_sdk.persistent_data.pre_set';

    /**
     * @var string
     */
    const SDK_PSEUDO_RANDOM_STRING_PRE_GET = 'facebook_sdk.pseudo_random_string.pre_get';

    /**
     * @var string
     */
    const SDK_PSEUDO_RANDOM_STRING_POST_GET = 'facebook_sdk.pseudo_random_string.post_get';

    /**
     * @var string
     */
    const SDK_URL_POST_GET_CURRENT_URL = 'facebook_sdk.url.post_get_current_url';
}
