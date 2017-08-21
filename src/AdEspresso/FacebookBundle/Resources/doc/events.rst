Events
======

There are currently 4 events dispatched by this bundle and you can find all of them inside the ``AdEspresso\FacebookBundle\Events`` class.

facebook_ads.http.request
-------------------------

Event that occurs before an Ads request is sent.

The event name is also available with ``Events::ADS_HTTP_REQUEST`` and will accept an argument of type ``AdEspresso\FacebookBundle\Event\Ads\HttpRequestEvent``.

facebook_ads.http.response
--------------------------

Event that occurs after an Ads response is sent.

The event name is also available with ``Events::ADS_HTTP_RESPONSE`` and will accept an argument of type ``AdEspresso\FacebookBundle\Event\Ads\HttpResponseEvent``.

facebook_sdk.http_client.pre_send
---------------------------------

Event that occurs before a HTTP request is sent with the SDK.

The event name is also available with ``Events::SDK_HTTP_CLIENT_PRE_SEND`` and will accept an argument of type ``AdEspresso\FacebookBundle\Event\Sdk\HttpClientPreSendEvent``.

facebook_sdk.http_client.post_send
----------------------------------

Event that occurs after a HTTP request is sent with the SDK.

The event name is also available with ``Events::SDK_HTTP_CLIENT_POST_SEND`` and will accept an argument of type ``AdEspresso\FacebookBundle\Event\Sdk\HttpClientPostSendEvent``.
