<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Forms extends AbstractWidget
{
    const JSON_RPC_VERSION = '2.0';

    const METHOD_URI = 'rpc';

    protected $client;

    protected $config = [
        'page_uid' => '',
        'fields' => null
    ];

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
            'base_uri' => env('APP_RPC_URI')
        ]);
    }

    public function call(string $method, array $params)
    {
        $response = $this->client
            ->post(self::METHOD_URI, [
                RequestOptions::JSON => [
                    'jsonrpc' => self::JSON_RPC_VERSION,
                    'id' => hrtime(true),
                    'method' => $method,
                    'params' => $params
                ]
            ])->getBody()->getContents();
        return json_decode($response, true);
    }

    public function rpc(string $method, array $params)
    {
        try {
            $response = $this->call($method, $params);
        }catch (\Exception $e){
        }
        if ($response){
            if (!array_key_exists('error', $response)) {
                return $response['result'];
            }
        }
        return null;
    }

    public function run()
    {
        $page_uid = $this->config['page_uid'];
        $fields = $this->config['fields'];
        if ($fields){
            $form = $this->rpc('add_page', ['page_uid' => $page_uid, 'fields' => $fields]);
            if ($form) {
                return view('widgets.forms', [
                    'page_uid' => $page_uid,
                    'fields' => $form['fields']
                ]);
            }
        }else {
            $form = $this->rpc('get_page', ['page_uid' => $page_uid]);
            if ($form) {
                return view('widgets.forms', [
                    'page_uid' => $page_uid,
                    'fields' => $form['fields']
                ]);
            }
        }
        return '';
    }
}
