<?php

namespace Dzaki236\RajaOngkir;

use Dzaki236\RajaOngkir\Contracts\HttpClientContract;
use Dzaki236\RajaOngkir\Contracts\SearchDriverContract;
use Dzaki236\RajaOngkir\HttpClients\AbstractClient;
use Dzaki236\RajaOngkir\HttpClients\BasicClient;
use Dzaki236\RajaOngkir\Resources\Kota;
use Dzaki236\RajaOngkir\Resources\OngkosKirim;
use Dzaki236\RajaOngkir\Resources\Provinsi;
use Dzaki236\RajaOngkir\SearchDrivers\AbstractDriver;
use Dzaki236\RajaOngkir\SearchDrivers\BasicDriver;

class RajaOngkir
{
    /** @var \Dzaki236\RajaOngkir\Contracts\HttpClientContract */
    protected $httpClient;

    /** @var \Dzaki236\RajaOngkir\Contracts\SearchDriverContract */
    protected $searchDriver;

    /** @var array */
    protected $options;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $package;

    /**
     * @param string $apiKey
     * @param string $package
     */
    public function __construct(string $apiKey, string $package = 'starter')
    {
        $this->apiKey = $apiKey;
        $this->package = $package;

        $this->setHttpClient(new BasicClient);
    }

    /**
     * @param \Dzaki236\RajaOngkir\Contracts\HttpClientContract $httpClient
     * @return self
     */
    public function setHttpClient(HttpClientContract $httpClient): self
    {
        $this->httpClient = $httpClient;
        $this->httpClient->setApiKey($this->apiKey);
        $this->httpClient->setPackage($this->package);

        return $this;
    }

    /**
     * @param \Dzaki236\RajaOngkir\Contracts\SearchDriverContract $searchDriver
     * @return self
     */
    public function setSearchDriver(SearchDriverContract $searchDriver): self
    {
        $this->searchDriver = $searchDriver;

        return $this;
    }

    /**
     * @return \Dzaki236\RajaOngkir\Resources\Provinsi;
     */
    public function provinsi(): Provinsi
    {
        $resource = new Provinsi($this->httpClient);

        if (null === $this->searchDriver) {
            $resource->setSearchDriver(new BasicDriver);
            $resource->setSearchColumn();
        }

        return $resource;
    }

    /**
     * @return \Dzaki236\RajaOngkir\Resources\Kota;
     */
    public function kota(): Kota
    {
        $resource = new Kota($this->httpClient);

        if (null === $this->searchDriver) {
            $resource->setSearchDriver(new BasicDriver);
            $resource->setSearchColumn();
        }

        return $resource;
    }

    /**
     * @param array $payload
     * @return \Dzaki236\RajaOngkir\Resources\OngkosKirim;
     */
    public function ongkosKirim(array $payload): OngkosKirim
    {
        return new OngkosKirim($this->httpClient, $payload);
    }

    /**
     * @return \Dzaki236\RajaOngkir\Resources\OngkosKirim;
     */
    public function ongkir(array $payload): OngkosKirim
    {
        return $this->ongkosKirim($payload);
    }

    /**
     * @return \Dzaki236\RajaOngkir\Resources\OngkosKirim;
     */
    public function biaya(array $payload): OngkosKirim
    {
        return $this->ongkosKirim($payload);
    }
}
