<?php

namespace TheRealGambo\Kong\Apis\Plugins;

use TheRealGambo\Kong\Apis\AbstractApi;

final class ConsumerRoute extends AbstractApi implements ConsumerRouteInterface
{
    public function create($identifier, array $body = [], array $headers = [])
    {
        return $this->request('POST','consumers/' . $identifier . '/routes', $body, $headers);
    }

    public function delete($identifier, array $body = [], array $headers = [])
    {
        return $this->request('DELETE', 'consumers/' . $identifier . '/routes', $body);
    }

    public function list($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('consumers/' . $identifier . '/routes', $params, $headers);
    }
}