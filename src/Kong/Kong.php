<?php

namespace TheRealGambo\Kong;

use TheRealGambo\Kong\Apis\Api;
use TheRealGambo\Kong\Apis\Certificate;
use TheRealGambo\Kong\Apis\Consumer;
use TheRealGambo\Kong\Apis\Node;
use TheRealGambo\Kong\Apis\Plugin;
use TheRealGambo\Kong\Apis\Plugins\BasicAuth;
use TheRealGambo\Kong\Apis\Plugins\Hmac;
use TheRealGambo\Kong\Apis\Plugins\KeyAuth;
use TheRealGambo\Kong\Apis\Plugins\Jwt;
use TheRealGambo\Kong\Apis\Plugins\Oauth2;
use TheRealGambo\Kong\Apis\Route;
use TheRealGambo\Kong\Apis\Service;
use TheRealGambo\Kong\Apis\Sni;
use TheRealGambo\Kong\Apis\Upstream;
use TheRealGambo\Kong\Exceptions\InvalidUrlException;
use Unirest\Request;

class Kong
{
    /**
     * The base URL to the Kong Gateway
     *
     * @var string
     */
    protected $url;

    /**
     * The port that the Kong Admin API is listening on
     *
     * @var int
     */
    protected $port;

    /**
     * Kong Class constructor.
     *
     * @param string  $url
     * @param integer $port
     * @param boolean $return_json
     * @param integer $default_timeout
     * @param boolean $verify_ssl
     *
     * @throws InvalidUrlException
     */
    public function __construct($url, $port = 8001, $return_json = true, $default_timeout = 5, $verify_ssl = false)
    {
        // Validate that the URL
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidUrlException('The configured Kong Admin URL is invalid.');
        }

        // Store the port and url
        $this->port = $port;
        $this->url  = rtrim($url, '/');

        // Configure the response to be a JSON object instead of \StdClass
        if ($return_json) {
            Request::jsonOpts(true, 512, JSON_NUMERIC_CHECK & JSON_FORCE_OBJECT & JSON_UNESCAPED_SLASHES);
        }

        // Set the default timeout for all requests
        Request::timeout($default_timeout);

        // Verify SSL if configured
        Request::verifyPeer($verify_ssl);

        // Ensure we are always sending and receiving JSON
        $this->setDefaultHeader('Content-Type', 'application/json');
        $this->setDefaultHeader('Accept', 'application/json');
    }

    /**
     * Set default header to be used on all requests
     *
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function setDefaultHeader($key, $value)
    {
        Request::defaultHeader($key, $value);
    }

    /**
     * Set default headers to be used on all requests
     *
     * @param array $headers
     *
     * @return void
     */
    public function setDefaultHeaders(array $headers = [])
    {
        Request::defaultHeaders($headers);
    }

    /**
     * Clear all default headers
     *
     * @return void
     */
    public function clearDefaultHeaders()
    {
        Request::clearDefaultHeaders();
    }

    /**
     * Returns a new instance of the Service endpoint
     *
     * @return Service
     */
    public function getServiceObject()
    {
        return new Service($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Route endpoint
     *
     * @return Route
     */
    public function getRouteObject()
    {
        return new Route($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Node endpoint
     *
     * @return Node
     */
    public function getNodeObject()
    {
        return new Node($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Api endpoint
     *
     * @deprecated
     *
     * @return Api
     */
    public function getApiObject()
    {
        return new Api($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Consumer endpoint
     *
     * @return Consumer
     */
    public function getConsumerObject()
    {
        return new Consumer($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Plugin endpoint
     *
     * @return Plugin
     */
    public function getPluginObject()
    {
        return new Plugin($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Certificate endpoint
     *
     * @return Certificate
     */
    public function getCertificateObject()
    {
        return new Certificate($this->url, $this->port);
    }

    /**
     * Returns a new instance of the SNI endpoint
     *
     * @return Sni
     */
    public function getSNIObject()
    {
        return new Sni($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Upstream endpoint
     *
     * @return Upstream
     */
    public function getUpstreamObject()
    {
        return new Upstream($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Key Auth plugin
     *
     * @return KeyAuth
     */
    public function getPluginKeyAuth()
    {
        return new KeyAuth($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Basic Auth Plugin
     *
     * @return BasicAuth
     */
    public function getPluginBasicAuth()
    {
        return new BasicAuth($this->url, $this->port);
    }

    /**
     * Returns a new instance of the JWT plugin
     *
     * @return Jwt
     */
    public function getPluginJwt()
    {
        return new Jwt($this->url, $this->port);
    }

    /**
     * Returns a new instance of the HMAC plugin
     *
     * @return \TheRealGambo\Kong\Apis\Plugins\Hmac
     */
    public function getPluginHmac()
    {
        return new Hmac($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Oauth2 plugin
     *
     * @return \TheRealGambo\Kong\Apis\Plugins\Oauth2
     */
    public function getPluginOauth2()
    {
        return new Oauth2($this->url, $this->port);
    }
}
