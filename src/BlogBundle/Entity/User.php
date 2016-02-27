<?php
// src/AppBundle/Entity/User.php

namespace BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\Tests\A;

/**
 * @ORM\Entity
 * @ORM\Table(name="kullanicilar")
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
     * @ORM\OneToMany(targetEntity="Takip",mappedBy="takip_eden")
     */
    private $takip_edenler;

    /**
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Takip",mappedBy="takip_edilen")
     */
    private $takip_edilenler;


    public function __construct()
    {
        parent::__construct();

        $this->takip_edenler=new ArrayCollection();
        $this->takip_edilenler=new ArrayCollection();

    }



    /**
     * Add takipEdenler
     *
     * @param \BlogBundle\Entity\Takip $takipEdenler
     *
     * @return User
     */
    public function addTakipEdenler(\BlogBundle\Entity\Takip $takipEdenler)
    {
        $this->takip_edenler[] = $takipEdenler;

        return $this;
    }

    /**
     * Remove takipEdenler
     *
     * @param \BlogBundle\Entity\Takip $takipEdenler
     */
    public function removeTakipEdenler(\BlogBundle\Entity\Takip $takipEdenler)
    {
        $this->takip_edenler->removeElement($takipEdenler);
    }

    /**
     * Get takipEdenler
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTakipEdenler()
    {
        return $this->takip_edenler;
    }

    /**
     * Add takipEdilenler
     *
     * @param \BlogBundle\Entity\Takip $takipEdilenler
     *
     * @return User
     */
    public function addTakipEdilenler(\BlogBundle\Entity\Takip $takipEdilenler)
    {
        $this->takip_edilenler[] = $takipEdilenler;

        return $this;
    }

    /**
     * Remove takipEdilenler
     *
     * @param \BlogBundle\Entity\Takip $takipEdilenler
     */
    public function removeTakipEdilenler(\BlogBundle\Entity\Takip $takipEdilenler)
    {
        $this->takip_edilenler->removeElement($takipEdilenler);
    }

    /**
     * Get takipEdilenler
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTakipEdilenler()
    {
        return $this->takip_edilenler;
    }
}