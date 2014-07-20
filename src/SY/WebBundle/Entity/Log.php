<?php

namespace SY\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SY\WebBundle\Entity\LogRepository")
 */
class Log
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="referrer", type="string", length=255, nullable=true)
     */
    private $referrer;

    /**
     * @var string
     *
     * @ORM\Column(name="agent", type="string", length=255)
     */
    private $agent;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="browser", type="string", length=255)
     */
    private $browser;

    /**
     * @var string
     *
     * @ORM\Column(name="OS", type="string", length=255)
     */
    private $oS;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hits
     *
     * @param integer $hits
     * @return Log
     */
    public function setHits($hits)
    {
        $this->hits = $hits;

        return $this;
    }

    /**
     * Get hits
     *
     * @return integer 
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Log
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set referrer
     *
     * @param string $referrer
     * @return Log
     */
    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * Get referrer
     *
     * @return string 
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * Set agent
     *
     * @param string $agent
     * @return Log
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return string 
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Log
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set browser
     *
     * @param string $browser
     * @return Log
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser
     *
     * @return string 
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set oS
     *
     * @param string $oS
     * @return Log
     */
    public function setOS($oS)
    {
        $this->oS = $oS;

        return $this;
    }

    /**
     * Get oS
     *
     * @return string 
     */
    public function getOS()
    {
        return $this->oS;
    }
}
