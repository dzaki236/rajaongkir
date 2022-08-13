<?php

namespace Dzaki236\RajaOngkir\Resources;

abstract class AbstractResource
{
    /** @var array */
    protected $result = [];

    /** @var \Dzaki236\RajaOngkir\HttpClients\AbstractClient */
    protected $httpClient;

    public function get(): array
    {
        return $this->result;
    }
}
