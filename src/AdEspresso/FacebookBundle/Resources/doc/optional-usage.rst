Optional Usage
==============

Both the two parts of this bundle can be disabled just by setting ``enabled`` to ``false``.
Of course you don't need to configure the part if disabled.

.. code-block:: yaml

    # app/config/config.yml
    facebook:
        sdk:
            enabled: false
        ads:
            # ...

the same is for the Ads part:

.. code-block:: yaml

    # app/config/config.yml
    facebook:
        sdk:
            # ...
        ads:
            enabled: false
