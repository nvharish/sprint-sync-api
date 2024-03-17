<?php

namespace App\Service;

use App\Dto\ProjectDto;
use Symfony\Component\HttpFoundation\Request;

class ProjectService
{

    private JiraService $jiraService;

    public function __construct(JiraService $jiraService)
    {
        $this->jiraService = $jiraService;
    }

    public function getProjects(): array
    {
        $uri = '/jira/rest/api/2/project';
        $data = $this->jiraService->send(Request::METHOD_GET, $uri);
        $projects = [];

        foreach ($data as $project) {
            $projectDto = new ProjectDto($project['key'], $project['name']);
            $projects[] = $projectDto;
        }

        return $projects;
    }
}
