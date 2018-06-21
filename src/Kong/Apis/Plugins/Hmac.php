<?php

namespace TheRealGambo\Kong\Apis\Plugins;

use TheRealGambo\Kong\Apis\AbstractApi;
use TheRealGambo\Kong\Apis\Consumer;

final class Hmac extends AbstractApi implements HmacInterface
{
    /**
     * Create a new consumer in Kong
     *
     * @see https://docs.konghq.com/plugins/hmac-authentication/#create-a-consumer
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
     * Create a new HMAC credential for a consumer
     *
     * @see https://docs.konghq.com/plugins/hmac-authentication/#create-a-credential
     *
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function create($identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(['username', 'secret']);
        $body = $this->createRequestBody($body);

        return $this->postRequest('consumers/' . $identifier . '/hmac-auth', $body, $headers);
    }

    /**
     * Delete a HMAC credential for a consumer
     *
     * @param string $identifier
     * @param string $hmac_identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($identifier, $hmac_identifier, array $headers = [])
    {
        return $this->deleteRequest('consumers/' . $identifier . '/hmac-auth/' . $hmac_identifier, $headers);
    }

    /**
     * List all HMAC credentials for a consumer
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function list($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers/' . $identifier . '/hmac-auth', $params, $headers);
    }
}
