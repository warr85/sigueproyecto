<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstatusUc
 *
 * @ORM\Table(name="estatus_uc", uniqueConstraints={@ORM\UniqueConstraint(name="uq_estatus_uc", columns={"nombre"})})
 * @ORM\Entity
 */
class EstatusUc
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false, options={"comment" = "Nombre del estatus unidad curricular"})
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del estatus unidad curricular"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="estatus_uc_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return EstatusUc
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
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
     * Get nombre
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getNombre();
    }


}
