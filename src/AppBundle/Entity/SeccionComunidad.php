<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeccionComunidad
 *
 * @ORM\Table(name="seccion_comunidad",
 *      uniqueConstraints=
 *          {@ORM\UniqueConstraint(name="uq_seccion_comunidad",
 *              columns={"nombre"})
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Seccion", inversedBy="comunidades" , cascade={"persist"})
     * @ORM\JoinTable(name="secciones_comunidades")
     *
     */
    private $idSeccion;


    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false, options={"comment" = "nombre de la Comunidad de ese Nucleo de proyecto"})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="text", nullable=true, options={"comment" = "Coordenadas poligonales de la ubicacion de la comunidad"})
     */
    private $ubicacion;



    /**
     *
     * @return string
     */

    public function __toString()
    {
        return $this->getNombre();
    }




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idSeccion = new \Doctrine\Common\Collections\ArrayCollection();

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
     *
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
     * Add idSeccion
     *
     * @param \AppBundle\Entity\Seccion $idSeccion
     *
     * @return SeccionComunidad
     */
    public function addIdSeccion(\AppBundle\Entity\Seccion $idSeccion)
    {
        $this->idSeccion[] = $idSeccion;

        return $this;
    }

    /**
     * Remove idSeccion
     *
     * @param \AppBundle\Entity\Seccion $idSeccion
     */
    public function removeIdSeccion(\AppBundle\Entity\Seccion $idSeccion)
    {
        $this->idSeccion->removeElement($idSeccion);
    }

    /**
     * Get idSeccion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdSeccion()
    {
        return $this->idSeccion;
    }



    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return SeccionComunidad
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }
}
