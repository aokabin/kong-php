<?php

namespace TheRealGambo\Kong\Apis\Plugins;

use TheRealGambo\Kong\Apis\AbstractApi;
use TheRealGambo\Kong\Apis\Consumer;

final class Oauth2 extends AbstractApi implements Oauth2Interface
{
    /**
     * Create a new consumer in Kong
     *
     * @see https://docs.konghq.com/plugins/oauth2-authentication/#create-a-consumer
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function createConsumer(array $body = [], array $headers = [])
    {
        $consumer = new Consumer($this->url, $this->port);

        return $consumer->add($body, $headers);
    }

    /**
     * Create a new Oauth2 credential for a consumer
     *
     * @see https://docs.konghq.com/plugins/oauth2-authentication/#create-an-application
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function create($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(['name', 'client_id', 'client_secret', 'redirect_uri']);
        $body = $this->createRequestBody($body);

        return $this->postRequest('consumers/' . $identifier . '/oauth2', $body, $headers);
    }

    /**
     * Delete a Oauth2 credential for a consumer
     *
     * @param string $identifier
     * @param string $oauth2_identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, $oauth2_identifier, array $headers = [])
    {
        return $this->deleteRequest('consumers/' . $identifier . '/oauth2/' . $oauth2_identifier, $headers);
    }

    /**
     * List all Oauth2 credentials for a consumer
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function list($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers/' . $identifier . '/oauth2', $params, $headers);
    }
}
