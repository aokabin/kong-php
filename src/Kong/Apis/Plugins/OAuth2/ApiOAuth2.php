<?php

namespace TheRealGambo\Kong\Apis\Plugins\OAuth2;

use TheRealGambo\Kong\Apis\AbstractApi;
use TheRealGambo\Kong\Apis\Plugins\OAuth2\ApiOAuth2Interface;

/**
 * Class ApiOAuth2
 * @package TheRealGambo\Kong\Apis
 */
final class ApiOAuth2 extends AbstractApi implements ApiOAuth2Interface
{
    /**
     * Post oauth2 authorize
     *
     * @see https://docs.konghq.com/hub/kong-inc/oauth2/
     *
     * @param array $identifier
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function authorize(string $identifier, array $body = [], array $headers = [])
    {
        $suffix = '/oauth2/authorize';
        $body = $this->createRequestBody($body);

        return $this->postRequest('apis/' . $identifier . $suffix, $body, $headers);
    }

    /**
     * Post oauth2 token
     *
     * @see https://docs.konghq.com/hub/kong-inc/oauth2/
     *
     * @param array $identifier
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function token(string $identifier, array $body = [], array $headers = [])
    {
        $suffix = '/oauth2/token';
        $body = $this->createRequestBody($body);

        return $this->postRequest('apis/' . $identifier . $suffix, $body, $headers);
    }
}
