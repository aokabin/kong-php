<?php

namespace TheRealGambo\Kong\Apis\Plugins\OAuth2;

interface ApiOAuth2Interface
{
    public function authorize(string $identifier, array $body = [], array $headers = []);
    public function token(string $identifier, array $body = [], array $headers = []);
}
