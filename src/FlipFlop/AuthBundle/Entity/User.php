<?php

namespace FlipFlop\AuthBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpKernel;
use FlipFlop\AuthBundle\Entity\UserGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="user",
 *     options={"comment" = "Contains application users."})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"comment" = "AUTO_INCREMENT"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="FlipFlop\SiteBundle\Entity\Video", mappedBy="user")
     */
    protected $videos;

    // ********************** Begin : Social network attributes. ********************** //
    /**
     * @var string
     *
     * @ORM\Column(name="facebook_account", type="string", length=255, nullable=true)
     */
    protected $facebook_account;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_id", type="string", length=255, nullable=true)
     */
    protected $twitter_account;

    /**
     * @var string
     *
     * @ORM\Column(name="gmail_email", type="string", length=255, nullable=true)
     */
    protected $gmail_account;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_channel", type="string", length=255, nullable=true)
     */
    protected $youtube_account;
    // ********************** End : Social network attributes. ********************** //


    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->username = "username";
        $this->groups = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->username = $this->email;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
