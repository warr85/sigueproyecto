<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeccionComunidad
 *
 * @ORM\Table(name="seccion_comunidad",
 *      uniqueConstraints=
 *          {@ORM\UniqueConstraint(name="uq_seccion_comunidad",
 *              columns={"nombre", "id_seccion"})
 *          }
 *  )
 * @ORM\Entity
 */
class SeccionComunidad
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de la inscripcion_ubicacion del estudiante"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="inscripcion_ubicacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


    /**
     * @var \AppBundle\Entity\Seccion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Seccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_seccion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idSeccion;


    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false, options={"comment" = "nombre de la Comunidad de ese Nucleo de proyecto"})
     */
    private $nombre;

    /**
     *
     * @return string
     */

    public function __toString()
    {
        return $this->getNombre();
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
     * Set nombre
     *
     * @param string $nombre
     * @return SeccionComunidad
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
     * Set idSeccion
     *
     * @param \AppBundle\Entity\Seccion $idSeccion
     * @return SeccionComunidad
     */
    public function setIdSeccion(\AppBundle\Entity\Seccion $idSeccion)
    {
        $this->idSeccion = $idSeccion;

        return $this;
    }

    /**
     * Get idSeccion
     *
     * @return \AppBundle\Entity\Seccion 
     */
    public function getIdSeccion()
    {
        return $this->idSeccion;
    }
}
