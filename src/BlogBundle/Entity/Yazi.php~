<?php

namespace BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Yazi
 *
 * @ORM\Table(name="yazilar")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\YaziRepository")
 */
class Yazi
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
     * @ORM\Column(name="icerik", type="string", length=255)
     */
    private $icerik;

    /**
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Yorum",mappedBy="yazi")
     */

    private $yorumlar;

    /**
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Begeni",mappedBy="yazi")
     */
    private $begeniler;

    /**
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\User",inversedBy="yazilar")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id",onDelete="CASCADE")
     */
    private $user;

    public function __construct()
    {
        $this->yorumlar=new ArrayCollection();
        $this->begeniler=new ArrayCollection();
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

    /**
     * Set icerik
     *
     * @param string $icerik
     *
     * @return Yazi
     */
    public function setIcerik($icerik)
    {
        $this->icerik = $icerik;

        return $this;
    }

    /**
     * Get icerik
     *
     * @return string
     */
    public function getIcerik()
    {
        return $this->icerik;
    }

    /**
     * Add yorumlar
     *
     * @param \BlogBundle\Entity\Yorum $yorumlar
     *
     * @return Yazi
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

    /**
     * Add begeniler
     *
     * @param \BlogBundle\Entity\Begeni $begeniler
     *
     * @return Yazi
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
     * Set user
     *
     * @param \BlogBundle\Entity\User $user
     *
     * @return Yazi
     */
    public function setUser(\BlogBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BlogBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
