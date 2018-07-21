<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="f_name", type="string", length=255)
     */
    private $fName;

    /**
     * @var string
     *
     * @ORM\Column(name="l_name", type="string", length=255)
     */
    private $lName;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=255)
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="Config", mappedBy="user")
     */
    private $configs;

    /**
     * @ORM\OneToMany(targetEntity="Graph", mappedBy="user")
     */
    private $graphs;

    /**
     * @ORM\OneToMany(targetEntity="Timeline", mappedBy="user")
     */
    private $timelines;

    public function __construct()
    {
        $this->active = true;
        $this->configs = new \Doctrine\Common\Collections\ArrayCollection();        
        $this->graphs = new \Doctrine\Common\Collections\ArrayCollection();        
        $this->timelines = new \Doctrine\Common\Collections\ArrayCollection();        
    }

    public function __toString() {
        return $this->fName;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fName
     *
     * @param string $fName
     *
     * @return User
     */
    public function setFName($fName)
    {
        $this->fName = $fName;

        return $this;
    }

    /**
     * Get fName
     *
     * @return string
     */
    public function getFName()
    {
        return $this->fName;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->active
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->active
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
    /**
     * Set lName
     *
     * @param string $lName
     *
     * @return User
     */
    public function setLName($lName)
    {
        $this->lName = $lName;

        return $this;
    }
    
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Get lName
     *
     * @return string
     */
    public function getLName()
    {
        return $this->lName;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set active
     *
     * @param string $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->active;
    }    

    /**
     * Add config
     *
     * @param \AppBundle\Entity\Config $config
     *
     * @return User
     */
    public function addConfig(\AppBundle\Entity\Config $config)
    {
        $this->configs[] = $config;

        return $this;
    }

    /**
     * Remove config
     *
     * @param \AppBundle\Entity\Config $config
     */
    public function removeConfig(\AppBundle\Entity\Config $config)
    {
        $this->configs->removeElement($config);
    }

    /**
     * Get configs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConfigs()
    {
        return $this->configs;
    }

    /**
     * Add graph
     *
     * @param \AppBundle\Entity\Graph $graph
     *
     * @return User
     */
    public function addGraph(\AppBundle\Entity\Graph $graph)
    {
        $this->graphs[] = $graph;

        return $this;
    }

    /**
     * Remove graph
     *
     * @param \AppBundle\Entity\Graph $graph
     */
    public function removeGraph(\AppBundle\Entity\Graph $graph)
    {
        $this->graphs->removeElement($graph);
    }

    /**
     * Get graphs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGraphs()
    {
        return $this->graphs;
    }

    /**
     * Add timeline
     *
     * @param \AppBundle\Entity\Timeline $timeline
     *
     * @return User
     */
    public function addTimeline(\AppBundle\Entity\Timeline $timeline)
    {
        $this->timelines[] = $timeline;

        return $this;
    }

    /**
     * Remove timeline
     *
     * @param \AppBundle\Entity\Timeline $timeline
     */
    public function removeTimeline(\AppBundle\Entity\Timeline $timeline)
    {
        $this->timelines->removeElement($timeline);
    }

    /**
     * Get timelines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTimelines()
    {
        return $this->timelines;
    }
}
