<?php

namespace App\Dto;

class ProjectDto
{
    /**
     * @var string The key of the project.
     */
    private string $key;

    /**
     * @var string The name of the project.
     */
    private string $name;

    public function __construct(string $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;
    }

    /**
     * Get the key of the project.
     *
     * @return string The key of the project.
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Set the key of the project.
     *
     * @param string $key The key of the project.
     * @return void
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * Get the name of the project.
     *
     * @return string The name of the project.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name of the project.
     *
     * @param string $name The name of the project.
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
