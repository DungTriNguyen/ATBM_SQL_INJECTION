<?php

class FeedbackDTO
{
    private $codeFeedback;
    private $userName;
    private $sentDate;
    private $email;
    private $content;
    private $replay;

    public function __construct($codeFeedback, $userName, $sentDate, $email, $content, $replay)
    {
        $this->codeFeedback = $codeFeedback;
        $this->userName = $userName;
        $this->sentDate = $sentDate;
        $this->email = $email;
        $this->content = $content;
        $this->replay = $replay;
    }

    public function getCodeFeedback()
    {
        return $this->codeFeedback;
    }

    public function setCodeFeedback($codeFeedback)
    {
        $this->codeFeedback = $codeFeedback;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getSentDate()
    {
        return $this->sentDate;
    }

    public function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getReplay()
    {
        return $this->replay;
    }

    public function setReplay($replay)
    {
        $this->replay = $replay;
    }

    public function __toString()
    {
        $output = "Code Feedback: " . $this->codeFeedback . "\n";
        $output .= "User Name: " . $this->userName . "\n";
        $output .= "Sent Date: " . $this->sentDate . "\n";
        $output .= "Email: " . $this->email . "\n";
        $output .= "Content: " . $this->content . "\n";
        $output .= "replay: " . $this->replay . "\n";

        return $output;
    }
}
