AdEspresso Facebook Bundle
==========================

Symfony Bundle for Facebook interactions' management.

The goal of this bundle is to improve the experience in the interactions between your application and the Facebook graph API.

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

.. code:: bash

    $ composer require adespresso/facebook-bundle

This command requires you to have `Composer`_ installed globally, as explained in the `installation chapter`_ of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding the following line in the ``app/AppKernel.php`` file of your project:

.. code:: php

    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...

                new AdEspresso\FacebookBundle\FacebookBundle(),
            );
        }
    }

Step 3: Configuration
---------------------

.. code:: yml

    # app/config/config.yml
    facebook:
        sdk:
            config:
                app_id: 'your_id'
                app_secret: 'your_secret'
        ads:
            config:
                app_id: 'your_id'
                app_secret: 'your_secret'

Usage
-----

The main usage of this bundle is with the official SDKs provided by Facebook for the graph APIs and the graph marketing APIs, and the Symfony events system.

For example you can use it to log graph responses:

.. code-block:: php

    // src/AppBundle/Listener/LogListener.php

    class LoggerListener
    {
        private $logger;

        public function __construct($logger)
        {
            $this->logger = $logger;
        }

        public function logBody(HttpClientPostSendEvent $event)
        {
            $graphRawResponse = $event->getGraphRawResponse();

            $this->logger->debug($graphRawResponse->getBody());
        }
    }

.. code-block:: yaml

    # app/config/services.yml

    services:
        app.logger_listener:
            class: AppBundle\Listener\LoggerListener
            arguments: ['@logger']
            tags:
                - { name: kernel.event_listener, event: facebook_sdk.http_client.post_send, method: logBody }

Readings:

-  `Configuration Reference`_
-  `Events`_
-  `Logging Channel`_
-  `Optional Usage`_
-  `Query Builder`_

.. _Composer: https://getcomposer.org/
.. _installation chapter: https://getcomposer.org/doc/00-intro.md
.. _Configuration Reference: https://github.com/adespresso/FacebookBundle/tree/master/Resources/doc/configuration-reference.rst
.. _Events: https://github.com/adespresso/FacebookBundle/tree/master/Resources/doc/events.rst
.. _Logging Channel: https://github.com/adespresso/FacebookBundle/tree/master/Resources/doc/logging-channel.rst
.. _Optional Usage: https://github.com/adespresso/FacebookBundle/tree/master/Resources/doc/optional-usage.rst
.. _Query Builder: https://github.com/adespresso/FacebookBundle/tree/master/Resources/doc/query-builder.rst

License
-------

This bundle is under the MIT license.
