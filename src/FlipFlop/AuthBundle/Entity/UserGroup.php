<?php

namespace FlipFlop\AuthBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserGroup.
 *
 * @ORM\Entity
 * @ORM\Table(name="user_group", options={"comment" = "AUTO_INCREMENT"})
 */
class UserGroup extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"comment" = "AUTO_INCREMENT"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;

     /**
      * ToString.
      *
      * @return string Group name.
      */
     public function __toString()
     {
         return $this->name;
     }
}