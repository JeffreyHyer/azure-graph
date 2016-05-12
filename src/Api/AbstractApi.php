<?php

namespace Azure\Api;

use GuzzleHttp\Client;

abstract class AbstractApi
{
    /**
     * [$client description]
     *
     * @var GuzzleHttp\Client
     */
    protected $azure;

    /**
     * [__construct description]
     *
     * @param \Azure\Azure $azure [description]
     */
    public function __construct(\Azure\Azure $azure)
    {
        $this->azure = $azure;
    }

    /**
     * [get description]
     *
     * @param  [type] $path     [description]
     * @param  [type] $queryStr [description]
     *
     * @return [type]           [description]
     */
    public function get($path, $queryStr = [])
    {
        try {
            $response = $this->azure->client->request(
                'GET',
                $this->azure->_buildUrl("", $path, $queryStr),
                [
                    'headers' => [
                        'Authorization' => $this->azure->_getAuthToken()
                    ]
                ]
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * [post description]
     *
     * @param  [type] $path     [description]
     * @param  [type] $body     [description]
     * @param  [type] $queryStr [description]
     *
     * @return [type]           [description]
     */
    public function post($path, $body, $queryStr = [])
    {
        try {
            $response = $this->azure->client->request(
                'POST',
                $this->azure->_buildUrl("", $path, $queryStr),
                [
                    'headers' => [
                        'Authorization' => $this->azure->_getAuthToken(),
                        'Content-Type'  => 'application/json'
                    ],
                    'body' => json_encode($body)
                ]
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * [patch description]
     *
     * @param  [type] $path     [description]
     * @param  [type] $body     [description]
     * @param  [type] $queryStr [description]
     *
     * @return [type]           [description]
     */
    public function patch($path, $body, $queryStr = [])
    {
        try {
            $response = $this->azure->client->request(
                'PATCH',
                $this->azure->_buildUrl("", $path, $queryStr),
                [
                    'headers' => [
                        'Authorization' => $this->azure->_getAuthToken(),
                        'Content-Type'  => 'application/json'
                    ],
                    'body' => ((is_array($body)) ? json_encode($body) : $body)
                ]
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * [delete description]
     *
     * @param  [type] $path     [description]
     * @param  [type] $queryStr [description]
     *
     * @return [type]           [description]
     */
    public function delete($path, $queryStr = [])
    {
        try {
            $response = $this->azure->client->request(
                'DELETE',
                $this->azure->_buildUrl("", $path, $queryStr),
                [
                    'headers' => [
                        'Authorization' => $this->azure->_getAuthToken()
                    ]
                ]
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * [_respond description]
     *
     * @param  Psr\Http\Message\ResponseInterface $response [description]
     *
     * @return [type]                                       [description]
     */
    protected function _respond(\Psr\Http\Message\ResponseInterface $response)
    {
        $retval = (object)[
            'code'      => $response->getStatusCode(),
            'reason'    => $response->getReasonPhrase(),
            'response'  => json_decode($response->getBody()->getContents())
        ];

        return $retval;
    }
}
