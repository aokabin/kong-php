<?php

namespace TheRealGambo\Kong\Apis\Plugins;

interface ConsumerRouteInterface
{
    public function create($identifier, array $body = [], array $headers = []);

    public function delete($identifier, array $body = [], array $headers = []);

    public function list($identifier, array $params = [], array $headers = []);
}