<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Graph
 *
 * @ORM\Table(name="graph")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GraphRepository")
 */
class Graph
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="y_axis_title", type="string", length=255)
     */
    private $yAxisTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="x_axis_title", type="string", length=255)
     */
    private $xAxisTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="relation", type="string", length=255)
     */
    private $relation;

    /**
     * @var string
     *
     * @ORM\Column(name="graph_groups", type="string", length=255)
     */
    private $graphGroups;

    /**
     * @var string
     *
     * @ORM\Column(name="show_groups", type="string", length=255)
     */
    private $showGroups;

    /**
     * @var string
     *
     * @ORM\Column(name="show_labels", type="string", length=255)
     */
    private $showLabels;

    /**
     * @var string
     *
     * @ORM\Column(name="x_interval", type="string", length=255)
     */
    private $xInterval;

    /**
     * @var string
     *
     * @ORM\Column(name="grouping", type="string", length=255)
     */
    private $grouping;

    /**
     * @var string
     *
     * @ORM\Column(name="maximum", type="string", length=255)
     */
    private $maximum;

    /**
     * @var string
     *
     * @ORM\Column(name="x_label_height", type="string", length=255)
     */
    private $xLabelHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="angle", type="string", length=255)
     */
    private $angle;

    /**
     * @var string
     *
     * @ORM\Column(name="group_angle", type="string", length=255)
     */
    private $groupAngle;

    /**
     * @ORM\OneToMany(targetEntity="Timeline", mappedBy="graph")
     */
    private $timelines;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="graphs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    public function __toString() {
        return $this->title;
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
     * Set title
     *
     * @param string $title
     *
     * @return Graph
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set yAxisTitle
     *
     * @param string $yAxisTitle
     *
     * @return Graph
     */
    public function setYAxisTitle($yAxisTitle)
    {
        $this->yAxisTitle = $yAxisTitle;

        return $this;
    }

    /**
     * Get yAxisTitle
     *
     * @return string
     */
    public function getYAxisTitle()
    {
        return $this->yAxisTitle;
    }

    /**
     * Set xAxisTitle
     *
     * @param string $xAxisTitle
     *
     * @return Graph
     */
    public function setXAxisTitle($xAxisTitle)
    {
        $this->xAxisTitle = $xAxisTitle;

        return $this;
    }

    /**
     * Get xAxisTitle
     *
     * @return string
     */
    public function getXAxisTitle()
    {
        return $this->xAxisTitle;
    }

    /**
     * Set xInterval
     *
     * @param string $xInterval
     *
     * @return Graph
     */
    public function setXInterval($xInterval)
    {
        $this->xInterval = $xInterval;

        return $this;
    }

    /**
     * Get xInterval
     *
     * @return string
     */
    public function getXInterval()
    {
        return $this->xInterval;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->timelines = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add timeline
     *
     * @param \AppBundle\Entity\Timeline $timeline
     *
     * @return Graph
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Graph
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
     * Set grouping
     *
     * @param string $grouping
     *
     * @return Graph
     */
    public function setGrouping($grouping)
    {
        $this->grouping = $grouping;

        return $this;
    }

    /**
     * Get grouping
     *
     * @return string
     */
    public function getGrouping()
    {
        return $this->grouping;
    }

    /**
     * Set maximum
     *
     * @param string $maximum
     *
     * @return Graph
     */
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;

        return $this;
    }

    /**
     * Get maximum
     *
     * @return string
     */
    public function getMaximum()
    {
        return $this->maximum;
    }

    /**
     * Set xLabelHeight
     *
     * @param string $xLabelHeight
     *
     * @return Graph
     */
    public function setXLabelHeight($xLabelHeight)
    {
        $this->xLabelHeight = $xLabelHeight;

        return $this;
    }

    /**
     * Get xLabelHeight
     *
     * @return string
     */
    public function getXLabelHeight()
    {
        return $this->xLabelHeight;
    }

    /**
     * Set angle
     *
     * @param string $angle
     *
     * @return Graph
     */
    public function setAngle($angle)
    {
        $this->angle = $angle;

        return $this;
    }

    /**
     * Get angle
     *
     * @return string
     */
    public function getAngle()
    {
        return $this->angle;
    }

    /**
     * Set relation
     *
     * @param string $relation
     *
     * @return Graph
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * Get relation
     *
     * @return string
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * Set graphGroups
     *
     * @param string $graphGroups
     *
     * @return Graph
     */
    public function setGraphGroups($graphGroups)
    {
        $this->graphGroups = $graphGroups;

        return $this;
    }

    /**
     * Get graphGroups
     *
     * @return string
     */
    public function getGraphGroups()
    {
        return $this->graphGroups;
    }

    /**
     * Set showGroups
     *
     * @param string $showGroups
     *
     * @return Graph
     */
    public function setShowGroups($showGroups)
    {
        $this->showGroups = $showGroups;

        return $this;
    }

    /**
     * Get showGroups
     *
     * @return string
     */
    public function getShowGroups()
    {
        return $this->showGroups;
    }

    /**
     * Set showLabels
     *
     * @param string $showLabels
     *
     * @return Graph
     */
    public function setShowLabels($showLabels)
    {
        $this->showLabels = $showLabels;

        return $this;
    }

    /**
     * Get showLabels
     *
     * @return string
     */
    public function getShowLabels()
    {
        return $this->showLabels;
    }

    /**
     * Set groupAngle
     *
     * @param string $groupAngle
     *
     * @return Graph
     */
    public function setGroupAngle($groupAngle)
    {
        $this->groupAngle = $groupAngle;

        return $this;
    }

    /**
     * Get groupAngle
     *
     * @return string
     */
    public function getGroupAngle()
    {
        return $this->groupAngle;
    }
}
