<?php

namespace FlipFlop\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Video
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="statut", type="boolean")
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="FlipFlop\SiteBundle\Entity\Newsletter")
     * @ORM\JoinColumn(name="id_newsletter", referencedColumnName="id")
     */
    protected $newsletter;

    /**
     * @ORM\ManyToOne(targetEntity="FlipFlop\SiteBundle\Entity\Category", cascade={"remove"})
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id", nullable=false)
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="FlipFlop\AuthBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", nullable=false)
     */
    protected $user;


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
     * Set name
     *
     * @param string $name
     * @return Video
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Video
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     * @return Video
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set newsletter
     *
     * @param \FlipFlop\SiteBundle\Entity\Newsletter $newsletter
     * @return Video
     */
    public function setNewsletter(\FlipFlop\SiteBundle\Entity\Newsletter $newsletter = null)
    {
        $this->newsletter = $newsletter;
    
        return $this;
    }

    /**
     * Get newsletter
     *
     * @return \FlipFlop\SiteBundle\Entity\Newsletter 
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set category
     *
     * @param \FlipFlop\SiteBundle\Entity\Category $category
     * @return Video
     */
    public function setCategory(\FlipFlop\SiteBundle\Entity\Category $category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \FlipFlop\SiteBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \FlipFlop\AuthBundle\Entity\User $user
     * @return Video
     */
    public function setUser(\FlipFlop\AuthBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \FlipFlop\AuthBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}