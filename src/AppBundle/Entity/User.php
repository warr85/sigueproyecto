<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
     * @ORM\OneToOne(targetEntity="Invitation", inversedBy="usuario")
     * @ORM\JoinColumn(referencedColumnName="code")
     * @Assert\NotNull(message="debe ingresar su número de cédula", groups={"Registration"})
     */
    protected $invitation;

    public function setInvitation(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function getInvitation()
    {
        return $this->invitation;
    }


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }



}
