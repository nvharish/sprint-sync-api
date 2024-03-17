<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Data Transfer Object (DTO) representing a sprint.
 */
class SprintDto
{
    #[Assert\NotBlank]
    private string $projectKey;

    #[Assert\NotBlank]
    #[Assert\Date]
    private string $startDate;

    #[Assert\NotBlank]
    #[Assert\Date]
    private string $endDate;

    /**
     * Gets the project key associated with the sprint.
     *
     * @return string The project key.
     */
    public function getProjectKey(): string
    {
        return $this->projectKey;
    }

    /**
     * Sets the project key associated with the sprint.
     *
     * @param string $projectKey The project key.
     * @return void
     */
    public function setProjectKey(string $projectKey): void
    {
        $this->projectKey = $projectKey;
    }

    /**
     * Gets the start date of the sprint.
     *
     * @return string The start date. (Format: Y-m-d)
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * Sets the start date of the sprint.
     *
     * @param string $startDate The start date. (Format: Y-m-d)
     * @return void
     */
    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * Gets the end date of the sprint.
     *
     * @return string The end date. (Format: Y-m-d)
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * Sets the end date of the sprint.
     *
     * @param string $endDate The end date. (Format: Y-m-d)
     * @return void
     */
    public function setEndDate(string $endDate): void
    {
        $this->endDate = $endDate;
    }
}
