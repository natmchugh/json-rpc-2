<?php

namespace Ndm\JsonRpc2\Client\Transport;

use \Ndm\JsonRpc2\Client\Exception as Exception;
use \Psr\Log\LoggerAwareInterface;
use \Psr\Log\LoggerInterface;
use \Psr\Log\NullLogger;

class SocketTransport implements TransportInterface, LoggerAwareInterface
{
    public function send($request)
    {
        return;
    }


    private function getConnection()
    {
        if (count($this->mockResponses) > 0) {
            $filename = array_shift($this->mockResponses);
            $this->handle = fopen($filename, 'r');
        }
        if (empty($this->handle)) {
            $this->handle = stream_socket_client(
                $this->url,
                $this->errno,
                $this->errstr,
                10,
                STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT
            );
            stream_set_timeout($this->handle , 2);
            stream_set_blocking($this->handle, 1);
        }
        return $this->handle;
    }

    private function closeConnection()
    {
        fclose($this->handle);
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}