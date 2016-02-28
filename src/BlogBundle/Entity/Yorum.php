<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Yorum
 *
 * @ORM\Table(name="yorumlar")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\YorumRepository")
 */
class Yorum
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
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Yazi", inversedBy="yorumlar")
     * @ORM\JoinColumn(name="yazi_id",referencedColumnName="id",onDelete="CASCADE")
     */
    private $yazi;


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
     * @return Yorum
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
     * Set yazi
     *
     * @param \BlogBundle\Entity\Yazi $yazi
     *
     * @return Yorum
     */
    public function setYazi(\BlogBundle\Entity\Yazi $yazi = null)
    {
        $this->yazi = $yazi;

        return $this;
    }

    /**
     * Get yazi
     *
     * @return \BlogBundle\Entity\Yazi
     */
    public function getYazi()
    {
        return $this->yazi;
    }
}
