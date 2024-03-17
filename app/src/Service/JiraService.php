<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class JiraService
{
    public function __construct(
        #[Autowire('%env(JIRA_BASE_URI)%')]
        private string $jiraBaseUri,
        #[Autowire('%env(JIRA_TOKEN)%')]
        private string $jiraToken
    ) {
    }

    public function send(string $method, string $uri)
    {
        $headers = [
            'Authorization' => "Bearer $this->jiraToken",
        ];
        $request = new Request($method, $this->jiraBaseUri . $uri, $headers);

        $client = new Client();
        $response = $client->sendAsync($request)->wait();

        return json_decode($response->getBody()->getContents(), true);
    }
}
