<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:40 AM
 */


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoInstitucion
 *
 * @ORM\Table(name="tipo_institucion", uniqueConstraints={@ORM\UniqueConstraint(name="uq_tipo_institucion", columns={"nombre"})})
 * @ORM\Entity
 */
class TipoInstitucion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=false, options={"comment" = "identificador del tipo de institucion"})
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "identificador del tipo de institucion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="tipo_institucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return TipoInstitucion
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