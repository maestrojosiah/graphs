<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timeline
 *
 * @ORM\Table(name="timeline")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TimelineRepository")
 */
class Timeline
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="figure", type="string", length=255)
     */
    private $figure;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=7)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="timelines")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Graph", inversedBy="timelines")
     * @ORM\JoinColumn(name="graph_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $graph;

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
     * Set description
     *
     * @param string $description
     *
     * @return Timeline
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set figure
     *
     * @param integer $figure
     *
     * @return Timeline
     */
    public function setFigure($figure)
    {
        $this->figure = $figure;

        return $this;
    }

    /**
     * Get figure
     *
     * @return int
     */
    public function getFigure()
    {
        return $this->figure;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Timeline
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Timeline
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set graph
     *
     * @param \AppBundle\Entity\Graph $graph
     *
     * @return Timeline
     */
    public function setGraph(\AppBundle\Entity\Graph $graph = null)
    {
        $this->graph = $graph;

        return $this;
    }

    /**
     * Get graph
     *
     * @return \AppBundle\Entity\Graph
     */
    public function getGraph()
    {
        return $this->graph;
    }
}
