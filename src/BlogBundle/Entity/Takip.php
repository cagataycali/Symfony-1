<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Takip
 *
 * @ORM\Table(name="takipler")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\TakipRepository")
 */
class Takip
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
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\User",inversedBy="takip_edenler")
     * @ORM\JoinColumn(name="takip_eden_id",referencedColumnName="id",onDelete="CASCADE")
     */
    private $takip_eden;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="takip_edilenler")
     * @ORM\JoinColumn(name="takip_edilen_id",referencedColumnName="id",onDelete="CASCADE")
     */
    private $takip_edilen;


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
     * Set takipEden
     *
     * @param \BlogBundle\Entity\User $takipEden
     *
     * @return Takip
     */
    public function setTakipEden(\BlogBundle\Entity\User $takipEden = null)
    {
        $this->takip_eden = $takipEden;

        return $this;
    }

    /**
     * Get takipEden
     *
     * @return \BlogBundle\Entity\User
     */
    public function getTakipEden()
    {
        return $this->takip_eden;
    }

    /**
     * Set takipEdilen
     *
     * @param \BlogBundle\Entity\User $takipEdilen
     *
     * @return Takip
     */
    public function setTakipEdilen(\BlogBundle\Entity\User $takipEdilen = null)
    {
        $this->takip_edilen = $takipEdilen;

        return $this;
    }

    /**
     * Get takipEdilen
     *
     * @return \BlogBundle\Entity\User
     */
    public function getTakipEdilen()
    {
        return $this->takip_edilen;
    }
}
