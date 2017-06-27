<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoSolicitud
 *
 * @ORM\Table(name="tipo_solicitud", uniqueConstraints={@ORM\UniqueConstraint(name="tipo_solicitud_nombre_key", columns={"nombre"})})
 * @ORM\Entity
 */
class TipoSolicitud
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=60, nullable=false, options={"comment" = "identificador del tipo de solicitud"})
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "nombre del tipo de solicitud"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="tipo_solicitud_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return TipoSolicitud
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
}
