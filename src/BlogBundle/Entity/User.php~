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
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Yazi",mappedBy="user")
     */
    private $yazilar;

    /**
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Begeni" , mappedBy="user")
     */
    private $begeniler;

    /**
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Yorum" , mappedBy="user")
     */
    private $yorumlar;

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

        $this->yazilar=new ArrayCollection();
        $this->yorumlar =new ArrayCollection();
        $this->takip_edenler=new ArrayCollection();
        $this->takip_edilenler=new ArrayCollection();
        $this->begeniler = new ArrayCollection();

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

    /**
     * Add yazilar
     *
     * @param \BlogBundle\Entity\Yazi $yazilar
     *
     * @return User
     */
    public function addYazilar(\BlogBundle\Entity\Yazi $yazilar)
    {
        $this->yazilar[] = $yazilar;

        return $this;
    }

    /**
     * Remove yazilar
     *
     * @param \BlogBundle\Entity\Yazi $yazilar
     */
    public function removeYazilar(\BlogBundle\Entity\Yazi $yazilar)
    {
        $this->yazilar->removeElement($yazilar);
    }

    /**
     * Get yazilar
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getYazilar()
    {
        return $this->yazilar;
    }

    /**
     * Add begeniler
     *
     * @param \BlogBundle\Entity\Begeni $begeniler
     *
     * @return User
     */
    public function addBegeniler(\BlogBundle\Entity\Begeni $begeniler)
    {
        $this->begeniler[] = $begeniler;

        return $this;
    }

    /**
     * Remove begeniler
     *
     * @param \BlogBundle\Entity\Begeni $begeniler
     */
    public function removeBegeniler(\BlogBundle\Entity\Begeni $begeniler)
    {
        $this->begeniler->removeElement($begeniler);
    }

    /**
     * Get begeniler
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBegeniler()
    {
        return $this->begeniler;
    }

    /**
     * Add yorumlar
     *
     * @param \BlogBundle\Entity\Yorum $yorumlar
     *
     * @return User
     */
    public function addYorumlar(\BlogBundle\Entity\Yorum $yorumlar)
    {
        $this->yorumlar[] = $yorumlar;

        return $this;
    }

    /**
     * Remove yorumlar
     *
     * @param \BlogBundle\Entity\Yorum $yorumlar
     */
    public function removeYorumlar(\BlogBundle\Entity\Yorum $yorumlar)
    {
        $this->yorumlar->removeElement($yorumlar);
    }

    /**
     * Get yorumlar
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getYorumlar()
    {
        return $this->yorumlar;
    }
}
