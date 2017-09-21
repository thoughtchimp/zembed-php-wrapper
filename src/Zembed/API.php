<?php
namespace Zembed;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class API extends Client
{
    protected $base_url = 'http://api.zembed.com';
    protected $curlOptions = [];
    protected $api_key;

    public function __construct($api_key, $base_url=null)
    {
        if(!is_null($base_url)) {
            $this->base_url = $base_url;
        }
        
        $this->api_key = $api_key;
        parent::__construct();
    }

    /* Embed */
    public function embed($url, array $params=[])
    {
        return $this->_get("/embed", array_merge([
            'url'   => $url
        ], $params));
    }

    public function embeds(array $urls, array $params=[])
    {
        return $this->_post("/embeds", array_merge([
            'urls'  => json_encode($urls)
        ], $params));
    }

    /* Common Request Functions */
    public function _get($endpoint, array $params=[])
    {
        return $this->_request('GET', $endpoint, [
            'query' => $params
        ]);
    }

    public function _post($endpoint, array $params=[])
    {
        return $this->_request('POST', $endpoint, [
            'form_params'  => $params
        ]);
    }

    public function _request($method, $endpoint, array $options=[])
    {
        $url = $this->base_url.$endpoint;

        try {
            $request = $this->request($method, $url, array_merge([
                'curl'  => $this->curlOptions, 'headers' => [
                    'api-key'      => $this->api_key,
                ]
            ], $options));

            return json_decode($request->getBody(),true);
        } catch(ClientException $e) {
            throw new ZembedApiException($e->getCode(), $e->getResponse()->getBody()->getContents());
        }
    }
}