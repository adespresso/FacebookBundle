Logging Channel
===============

Every log message sent from the bundle goes into the ``facebook`` monolog channel.
Read more about how to use channels in the `official Symfony documentation`_.



For example to not group them into the main log file:

.. code-block:: yaml

    # app/config/config.yml
    monolog:
        handlers:
            main:
                level: debug
                type: stream
                path: '%kernel.logs_dir%/%kernel.environment%.log'
                channels: ['!facebook']
            facebook:
                level: debug
                type: stream
                path: '%kernel.logs_dir%/facebook-requests.log'
                channels: ['facebook']

.. _official Symfony documentation: https://symfony.com/doc/current/logging/channels_handlers.html
