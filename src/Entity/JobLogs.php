<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Cassandra\Bigint;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=JobLogsRepository::class)
 */
class JobLogs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable()
     */
    private $moment;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $project;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $messageType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="bigint", length=255)
     */
    private $duration;

    /**
     * @return mixed
     */
    public function getId() : int
    {
        return $this->id;
    }

    public function getMoment(): ? \DateTimeInterface
    {
        return $this->moment;
    }

    public function setMoment(\DateTimeInterface $moment): self
    {
        $this->moment = $moment;
        return $this;
    }

    public function getProject() : string
    {
        return $this->project;
    }

    public function setProject(string $project) : self
    {
        $this->project = $project;
        return $this;
    }

    public function getJob() : string
    {
        return $this->job;
    }

    public function setJob(string $job) : self
    {
        $this->job = $job;
        return $this;
    }

    public function getMessageType() : string
    {
        return $this->messageType;
    }

    public function setMessageType(string $messageType) : self
    {
        $this->messageType = $messageType;
        return $this;
    }

    public function getMessage() : string
    {
        return $this->message;
    }

    public function setMessage(string $message) : self
    {
        $this->message = $message;
        return $this;
    }

    public function getDuration() : Bigint
    {
        return $this->duration;
    }

    public function setDuration(Bigint $duration) : self
    {
        $this->duration = $duration;
        return $this;
    }
}
