<?php

namespace Azure;

use GuzzleHttp\Client;

class Azure
{

    /**
     * The Guzzle instance used for all requests to the Graph API
     *
     * @var \GuzzleHttp\Client
     */
    public $client;

    /**
     * Application Client ID
     *
     * @var string
     */
    public $clientId;

    /**
     * Application Client Secret
     *
     * @var string
     */
    public $clientSecret;

    /**
     * Azure AD Tenant (verified domain)
     *
     * @var string
     */
    public $tenant;

    /**
     * Type of access token, as returned by the Graph API
     *
     * @var string
     */
    public $authTokenType;

    /**
     * Access token used to authenticate all calls to the Graph API
     *
     * @var string
     */
    public $authToken;

    /**
     * The default configuration options
     *
     * @var array
     */
    public $options = [
        'base_uri' => 'https://graph.windows.net/',
        'api_version' => '1.6'
    ];

    /**
     * Azure\Azure constructure
     *
     * @param string    $clientId       Your application's Client ID
     * @param string    $clientSecret   Your application's Client Secret
     * @param array     $options        Array of options to override defaults
     */
    public function __construct($clientId, $clientSecret, $tenant, $options = [])
    {
        if (is_null($clientId)) {
            throw new \Exception("Client ID must be provided");
        }

        if (is_null($clientSecret)) {
            throw new \Exception("Client Secret must be provided");
        }

        if (is_null($tenant)) {
            throw new \Exception("Tenant must be provided");
        }

        $this->clientId         = $clientId;
        $this->clientSecret     = $clientSecret;
        $this->tenant           = $tenant;

        $this->options = array_merge($options, $this->options);

        $this->client = new Client();
    }

    /**
     * [_buildUrl description]
     *
     * @param  [type] $domain       [description]
     * @param  string $path         [description]
     * @param  [type] $queryStrings [description]
     *
     * @return [type]               [description]
     */
    public function _buildUrl($domain, $path = "", $queryStrings = [])
    {
        $queryString = "?api-version={$this->options['api_version']}";
        foreach ($queryStrings as $key => $value) {
            if (is_array($value)) {
                continue;
            }

            $queryString .= "&{$key}={$value}";
        }

        if ($domain == "") {
            $domain = $this->options['base_uri'];
        }

        $path = "/" . trim($path, "/");

        return "{$domain}{$this->tenant}{$path}{$queryString}";
    }

    /**
     * [_getAuthToken description]
     *
     * @return [type] [description]
     */
    public function _getAuthToken()
    {
        if (is_null($this->authToken)) {
            $response = $this->client->request(
                'POST',
                $this->_buildUrl('https://login.windows.net/', "/oauth2/token", []),
                [
                    'body' => "grant_type=client_credentials&resource=" . urlencode($this->options['base_uri']) . "&client_id=" . urlencode($this->clientId) . "&client_secret=" . urlencode($this->clientSecret)
                ]
            );

            $response = json_decode($response->getBody()->getContents());

            $this->authToken = "{$response->token_type} {$response->access_token}";
        }

        return $this->authToken;
    }

    protected function api($name)
    {
        switch ($name) {
            case 'apps':
            case 'applications':
                $api = new Api\Applications($this);
                break;

            case 'user':
            case 'users':
                $api = new Api\Users($this);
                break;

            default:
                return new \Exception("Invalid API ($name)");
        }

        return $api;
    }

    /**
     * [__call description]
     *
     * @param  [type] $method [description]
     * @param  [type] $args   [description]
     *
     * @return [type]         [description]
     *
     * @todo   $args doesn't do anything right now. Is it needed?
     */
    public function __call($method, $args)
    {
        return $this->api($method);
    }
}
