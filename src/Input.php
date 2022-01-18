<?php

namespace Minicli;

use RuntimeException;

class Input
{
    /** @var array  */
    protected $inputHistory = [];

    /** @var string */
    protected $prompt;

    /**
     * @throws RuntimeException if the readline extension is not loaded.
     */
    public function __construct($prompt = 'minicli$> ')
    {
        $this->checkReadlineExtension();
        $this->setPrompt($prompt);
    }

    /**
     * @throws RuntimeException if the readline extension is not loaded.
     */
    public function read()
    {
        $this->checkReadlineExtension();
        $input = readline($this->getPrompt());
        $this->inputHistory[] = $input;

        return $input;
    }

    /**
     * @return array
     */
    public function getInputHistory()
    {
        return $this->inputHistory;
    }

    /**
     * @return string
     */
    public function getPrompt()
    {
        return $this->prompt;
    }

    /**
     * @param string $prompt
     */
    public function setPrompt(string $prompt)
    {
        $this->prompt = $prompt;
    }

    /**
     * @throws RuntimeException if the readline extension is not loaded.
     */
    private function checkReadlineExtension()
    {
        if (extension_loaded('readline')) {
            return;
        }

        throw new RuntimeException('Extension readline is required.');
    }
}
