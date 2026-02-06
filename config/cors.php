<?php

return [
	
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => ['*'],

    'allowed_headers' => ['*'],

    'exposed_headers' => ['X-CSRF-TOKEN'],

    'max_age' => 10,

    'supports_credentials' => true,

];