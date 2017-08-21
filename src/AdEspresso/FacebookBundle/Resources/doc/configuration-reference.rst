Default Bundle Configuration
============================

.. code-block:: yaml

    # app/config/config.yml
    facebook:
        sdk:                  # Required
            enabled:              true
            config:
                app_id:               ~ # Required
                app_secret:           ~ # Required
                default_access_token: null
                default_graph_version: v2.10
                enable_beta_mode:     false
                http_client_handler:  null
                persistent_data_handler: null
                pseudo_random_string_generator: null
                url_detection_handler: null
        ads:                  # Required
            enabled:              true
            config:
                app_id:               ~ # Required
                app_secret:           ~ # Required
                default_access_token: null
                default_graph_version: v2.10
            options:
                use_implicit_fetch:   false
