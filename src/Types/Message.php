<?php namespace SMSFetcher\Types;

class Message {
    /**
     * @var string
     */
    protected $from;

    /**
     * @var string
     */
    protected $content;

    /**
     * @return string
     */
    public function getFrom(): string {
        return $this->from;
    }

    /**
     * @param string $from
     */
    public function setFrom(string $from): void {
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void {
        $this->content = $content;
    }
}