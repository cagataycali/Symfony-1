<?php

namespace BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Begeni
 *
 * @ORM\Table(name="begeniler")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\BegeniRepository")
 */
class Begeni
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
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Yazi",inversedBy="begeniler")
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
     * Set yazi
     *
     * @param \BlogBundle\Entity\Yazi $yazi
     *
     * @return Begeni
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
