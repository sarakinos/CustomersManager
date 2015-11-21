<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/11/2015
 * Time: 5:38 μμ
 */

namespace AppBundle\Entity;


class Mail
{
    protected $subject;
    protected $body;
    protected $from;
    protected $to;

    public function getSubject()
    {
        return $this->subject;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    public function getBody()
    {
        return $this->body;
    }
    public function setBody($body)
    {
        $this->body = $body;
    }
    public function getTo()
    {
        return $this->to;
    }
    public function setTo($to)
    {
        $this->to = $to;
    }
    public function getFrom()
    {
        return $this->from;
    }
    public function setFrom($from)
    {
        $this->from = $from;
    }
}