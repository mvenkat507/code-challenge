<?php

namespace App\Factory;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ResponseFactory {

    public function __construct(private SerializerInterface $serializer)
    {
        
    }

    public function createXMLResponse(array $data, string $xmlRoot, int $status = 200, array $headers = []): Response
    {
        return new Response(
            $this->serializer->serialize(
                $data,
                XmlEncoder::FORMAT,
                [
                    XmlEncoder::ROOT_NODE_NAME => $xmlRoot,
                    XmlEncoder::ENCODING => 'UTF-8',
                ]
            ),
            $status,
            array_merge($headers, ['Content-Type' => 'application/xml;charset=UTF-8'])
        );
    }

    public function createJsonResponse(array $data, $status = 200, array $headers = []): Response
    {
        return new Response(
            $this->serializer->serialize(
                $data,
                "json"
            ),
            $status,
            array_merge($headers, ['Content-Type' => 'application/json;charset=UTF-8'])
        );
    }

    public function createCSVResponse(array $data, $status = 200, array $headers = []): Response
    {
        return new Response(
            $this->serializer->serialize(
                $data,
                "csv"
            ),
            $status,
            array_merge($headers, ['Content-Type' => 'text/csv;charset=UTF-8'])
        );
    }
}