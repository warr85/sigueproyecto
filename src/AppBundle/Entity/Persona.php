<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Persona
 *
 * @ORM\Table(name="persona", uniqueConstraints={@ORM\UniqueConstraint(name="uq_persona", columns={"cedula_pasaporte"})}, indexes={@ORM\Index(name="fki_pais_nacimiento_persona", columns={"id_pais_nacimiento"}), @ORM\Index(name="fki_estado_civil_persona", columns={"id_estado_civil"}), @ORM\Index(name="fki_", columns={"id_genero"}), @ORM\Index(name="fki_documento_identidad_persona", columns={"id_documento_identidad"}), @ORM\Index(name="IDX_51E5B69BB0DC2AB1", columns={"id_nacionalidad"})})
 * @ORM\Entity(repositoryClass="PersonaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Persona
{
    /**
     * @var string
     *
     * @ORM\Column(name="primer_nombre", type="string", length=20, nullable=false, options={"comment" = "primer nombre persona"})
     */
    private $primerNombre;



    /**
     * @var string
     *
     * @ORM\Column(name="segundo_nombre", type="string", length=70, nullable=true, options={"comment" = "segundo y otros nombres persona"})
     */
    private $segundoNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_apellido", type="string", length=20, nullable=false, options={"comment" = "primer apellido persona"})
     */
    private $primerApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_apellido", type="string", length=70, nullable=true, options={"comment" = "segundo y otros apellidos persona"})
     */
    private $segundoApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula_pasaporte", type="string", length=15, nullable=false, options={"comment" = "Numero de cedula o pasaporte de la persona"})
     */
    private $cedulaPasaporte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false, options={"comment" = "fecha de nacimiento de la persona"})
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="correo_electronico", type="string", length=80, nullable=true, options={"comment" = "nombre de correo electronico de la apersona"})
     */
    private $correoElectronico;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_residencia", type="text", nullable=false, options={"comment" = "direccion de residencia de la persona"})
     */
    private $direccionResidencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=false, options={"comment" = "fecha de realizacion del registro"})
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="date", nullable=false, options={"comment" = "fecha de actualizacion del registro"})
     */
    private $fechaActualizacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="privado_libertad", type="boolean", nullable=true, options={"comment" = "indica si la persona esta privada de libertad", "default" = false})
     */
    private $privadoLibertad;




    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", options={"comment" = "identificador de la persona"}, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="persona_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\PaisNacimiento
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PaisNacimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais_nacimiento", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPaisNacimiento;

    /**
     * @var \AppBundle\Entity\Nacionalidad
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Nacionalidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nacionalidad", referencedColumnName="id", nullable=false)
     * })
     */
    private $idNacionalidad;

    /**
     * @var \AppBundle\Entity\Genero
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Genero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_genero", referencedColumnName="id", nullable=false)
     * })
     */
    private $idGenero;

    /**
     * @var \AppBundle\Entity\EstadoCivil
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EstadoCivil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado_civil", referencedColumnName="id", nullable=false)
     * })
     */
    private $idEstadoCivil;

    /**
     * @var \AppBundle\Entity\DocumentoIdentidad
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DocumentoIdentidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_documento_identidad", referencedColumnName="id", nullable=false)
     * })
     */
    private $idDocumentoentidad;

    /**
     * @ORM\OneToOne(targetEntity="PersonaSocioEconomico", mappedBy="idPersona", cascade={"remove"})
     */
    private $socioEconomico;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PersonaVotacion", mappedBy="idPersona", cascade={"remove"})
     */
    private $centroVotacion;

     /**
     * @ORM\OneToMany(targetEntity="PersonaInstitucion", mappedBy="idPersona", cascade={"remove"})
     */
    private $instituciones;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonaDiscapacidad", mappedBy="idPersona", cascade={"remove"})
     */
    private $discapacidades;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonaFamiliar", mappedBy="idPersona", cascade={"persist","remove"})
     */
    private $familiares;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonaMision", mappedBy="idPersona", cascade={"persist","remove"})
     */
    private $misiones;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TelefonoPersona", mappedBy="idPersona", cascade={"persist","remove"})
     */
    private $telefonos;



    /**
     * Set primerNombre
     *
     * @param string $primerNombre
     * @return Persona
     */
    public function setPrimerNombre($primerNombre)
    {
        $this->primerNombre = $primerNombre;

        return $this;
    }

    /**
     * Get primerNombre
     *
     * @return string
     */
    public function getPrimerNombre()
    {
        return $this->primerNombre;
    }

    /**
     * Set segundoNombre
     *
     * @param string $segundoNombre
     * @return Persona
     */
    public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;

        return $this;
    }

    /**
     * Get segundoNombre
     *
     * @return string
     */
    public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     * @return Persona
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     * @return Persona
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set cedulaPasaporte
     *
     * @param string $cedulaPasaporte
     * @return Persona
     */
    public function setCedulaPasaporte($cedulaPasaporte)
    {
        $this->cedulaPasaporte = $cedulaPasaporte;

        return $this;
    }

    /**
     * Get cedulaPasaporte
     *
     * @return string
     */
    public function getCedulaPasaporte()
    {
        return $this->cedulaPasaporte;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set correoElectronico
     *
     * @param string $correoElectronico
     * @return Persona
     */
    public function setCorreoElectronico($correoElectronico)
    {
        $this->correoElectronico = $correoElectronico;

        return $this;
    }

    /**
     * Get correoElectronico
     *
     * @return string
     */
    public function getCorreoElectronico()
    {
        return $this->correoElectronico;
    }

    /**
     * Set direccionResidencia
     *
     * @param string $direccionResidencia
     * @return Persona
     */
    public function setDireccionResidencia($direccionResidencia)
    {
        $this->direccionResidencia = $direccionResidencia;

        return $this;
    }

    /**
     * Get direccionResidencia
     *
     * @return string
     */
    public function getDireccionResidencia()
    {
        return $this->direccionResidencia;
    }



    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }



    /**
     * Get fechaActualizacion
     *
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Set privadoLibertad
     *
     * @param boolean $privadoLibertad
     * @return Persona
     */
    public function setPrivadoLibertad($privadoLibertad)
    {
        $this->privadoLibertad = $privadoLibertad;

        return $this;
    }

    /**
     * Get privadoLibertad
     *
     * @return boolean
     */
    public function getPrivadoLibertad()
    {
        return $this->privadoLibertad;
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
     * Set idPaisNacimiento
     *
     * @param \AppBundle\Entity\PaisNacimiento $idPaisNacimiento
     * @return Persona
     */
    public function setIdPaisNacimiento(\AppBundle\Entity\PaisNacimiento $idPaisNacimiento = null)
    {
        $this->idPaisNacimiento = $idPaisNacimiento;

        return $this;
    }

    /**
     * Get idPaisNacimiento
     *
     * @return \AppBundle\Entity\PaisNacimiento
     */
    public function getIdPaisNacimiento()
    {
        return $this->idPaisNacimiento;
    }

    /**
     * Set idNacionalidad
     *
     * @param \AppBundle\Entity\Nacionalidad $idNacionalidad
     * @return Persona
     */
    public function setIdNacionalidad(\AppBundle\Entity\Nacionalidad $idNacionalidad = null)
    {
        $this->idNacionalidad = $idNacionalidad;

        return $this;
    }

    /**
     * Get idNacionalidad
     *
     * @return \AppBundle\Entity\Nacionalidad
     */
    public function getIdNacionalidad()
    {
        return $this->idNacionalidad;
    }

    /**
     * Set idGenero
     *
     * @param \AppBundle\Entity\Genero $idGenero
     * @return Persona
     */
    public function setIdGenero(\AppBundle\Entity\Genero $idGenero = null)
    {
        $this->idGenero = $idGenero;

        return $this;
    }

    /**
     * Get idGenero
     *
     * @return \AppBundle\Entity\Genero
     */
    public function getIdGenero()
    {
        return $this->idGenero;
    }

    /**
     * Set idEstadoCivil
     *
     * @param \AppBundle\Entity\EstadoCivil $idEstadoCivil
     * @return Persona
     */
    public function setIdEstadoCivil(\AppBundle\Entity\EstadoCivil $idEstadoCivil = null)
    {
        $this->idEstadoCivil = $idEstadoCivil;

        return $this;
    }

    /**
     * Get idEstadoCivil
     *
     * @return \AppBundle\Entity\EstadoCivil
     */
    public function getIdEstadoCivil()
    {
        return $this->idEstadoCivil;
    }

    /**
     * Set idDocumentoentidad
     *
     * @param \AppBundle\Entity\DocumentoIdentidad $idDocumentoentidad
     * @return Persona
     */
    public function setIdDocumentoentidad(\AppBundle\Entity\DocumentoIdentidad $idDocumentoentidad = null)
    {
        $this->idDocumentoentidad = $idDocumentoentidad;

        return $this;
    }

    /**
     * Get idDocumentoentidad
     *
     * @return \AppBundle\Entity\DocumentoIdentidad
     */
    public function getIdDocumentoentidad()
    {
        return $this->idDocumentoentidad;
    }


    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->fechaRegistro = new \DateTime();
        $this->fechaActualizacion = new \DateTime();
    }


    /**
     * @ORM\PreUpdate()
     */
    public function setUpdateAtValue()
    {
        $this->fechaActualizacion = new \DateTime();
    }


    public function __toString() {
        return $this->getPrimerNombre() . " " . $this->getPrimerApellido();
    }





    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Persona
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Persona
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set socioEconomico
     *
     * @param \AppBundle\Entity\PersonaSocioEconomico $socioEconomico
     * @return Persona
     */
    public function setSocioEconomico(\AppBundle\Entity\PersonaSocioEconomico $socioEconomico = null)
    {
        $this->socioEconomico = $socioEconomico;

        return $this;
    }

    /**
     * Get socioEconomico
     *
     * @return \AppBundle\Entity\PersonaSocioEconomico 
     */
    public function getSocioEconomico()
    {
        return $this->socioEconomico;
    }
    /**
     * Constructor
     */

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->instituciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->discapacidades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->familiares = new \Doctrine\Common\Collections\ArrayCollection();
        $this->misiones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->telefonos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add instituciones
     *
     * @param \AppBundle\Entity\PersonaInstitucion $instituciones
     * @return Persona
     */
    public function addInstitucione(\AppBundle\Entity\PersonaInstitucion $instituciones)
    {
        $this->instituciones[] = $instituciones;

        return $this;
    }

    /**
     * Remove instituciones
     *
     * @param \AppBundle\Entity\PersonaInstitucion $instituciones
     */
    public function removeInstitucione(\AppBundle\Entity\PersonaInstitucion $instituciones)
    {
        $this->instituciones->removeElement($instituciones);
    }

    /**
     * Get instituciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInstituciones()
    {
        return $this->instituciones;
    }

    /**
     * Add discapacidades
     *
     * @param \AppBundle\Entity\PersonaDiscapacidad $discapacidades
     * @return Persona
     */
    public function addDiscapacidade(\AppBundle\Entity\PersonaDiscapacidad $discapacidades)
    {
        $this->discapacidades[] = $discapacidades;

        return $this;
    }

    /**
     * Remove discapacidades
     *
     * @param \AppBundle\Entity\PersonaDiscapacidad $discapacidades
     */
    public function removeDiscapacidade(\AppBundle\Entity\PersonaDiscapacidad $discapacidades)
    {
        $this->discapacidades->removeElement($discapacidades);
    }

    /**
     * Get discapacidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiscapacidades()
    {
        return $this->discapacidades;
    }

    /**
     * Add familiares
     *
     * @param \AppBundle\Entity\PersonaFamiliar $familiares
     * @return Persona
     */
    public function addFamiliare(\AppBundle\Entity\PersonaFamiliar $familiares)
    {
        $this->familiares[] = $familiares;

        return $this;
    }

    /**
     * Remove familiares
     *
     * @param \AppBundle\Entity\PersonaFamiliar $familiares
     */
    public function removeFamiliare(\AppBundle\Entity\PersonaFamiliar $familiares)
    {
        $this->familiares->removeElement($familiares);
    }

    /**
     * Get familiares
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFamiliares()
    {
        return $this->familiares;
    }

    /**
     * Set centroVotacion
     *
     * @param \AppBundle\Entity\PersonaVotacion $centroVotacion
     * @return Persona
     */
    public function setCentroVotacion(\AppBundle\Entity\PersonaVotacion $centroVotacion = null)
    {
        $this->centroVotacion = $centroVotacion;

        return $this;
    }

    /**
     * Get centroVotacion
     *
     * @return \AppBundle\Entity\PersonaVotacion 
     */
    public function getCentroVotacion()
    {
        return $this->centroVotacion;
    }

    /**
     * Add misiones
     *
     * @param \AppBundle\Entity\PersonaMision $misiones
     * @return Persona
     */
    public function addMisione(\AppBundle\Entity\PersonaMision $misiones)
    {
        $this->misiones[] = $misiones;

        return $this;
    }

    /**
     * Remove misiones
     *
     * @param \AppBundle\Entity\PersonaMision $misiones
     */
    public function removeMisione(\AppBundle\Entity\PersonaMision $misiones)
    {
        $this->misiones->removeElement($misiones);
    }

    /**
     * Get misiones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMisiones()
    {
        return $this->misiones;
    }

    /**
     * Add telefonos
     *
     * @param \AppBundle\Entity\TelefonoPersona $telefonos
     * @return Persona
     */
    public function addTelefono(\AppBundle\Entity\TelefonoPersona $telefonos)
    {
        $this->telefonos[] = $telefonos;

        return $this;
    }

    /**
     * Remove telefonos
     *
     * @param \AppBundle\Entity\TelefonoPersona $telefonos
     */
    public function removeTelefono(\AppBundle\Entity\TelefonoPersona $telefonos)
    {
        $this->telefonos->removeElement($telefonos);
    }

    /**
     * Get telefonos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }
}
