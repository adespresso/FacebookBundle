Query Builder
=============

This bundle is also integrated with the `sammyk/facebook-query-builder <https://github.com/SammyK/FacebookQueryBuilder>`_ so you can define queries exactly like you do with Doctrine Query Builder.

You can read more about how to use the library on `the GitHub page of the library <https://github.com/SammyK/FacebookQueryBuilder#usage>`_ and on `the Facebook documentation <https://developers.facebook.com/docs/graph-api/using-graph-api>`_.


Where's the integration?
------------------------

The query builder is given only if the SDK is enabled and initialized with the SDK configuration, so there's no need to configure the query builder too.

Second thing is that there's a ``get`` method provided in the adapter with the same parameters excluding the endpoint to require.

For example the following code will call a ``GET /me?fields=id,email`` and give a ``Facebook\FacebookResponse``

.. code-block:: php

        $fqb
            ->node('me')
            ->fields(['id', 'email'])
            ->get();

As visible above, the Query Builder implements a fluid interface, so the same instance can't be used multiple times.
To create multiple instances of the Query Builder you need to call the service multiple times, changes done to an instance won't be shared with other instances.

.. code-block:: php

        public function exampleAction()
        {
            $fqb1 = $this->get('facebook.sdk.query_builder');
            $fqb2 = $this->get('facebook.sdk.query_builder');

            // $fqb1 and $fqb2 won't share changes each other
        }
