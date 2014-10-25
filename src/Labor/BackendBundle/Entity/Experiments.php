<?php

namespace Labor\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experiments
 *
 * @ORM\Table(name="experiments", indexes={@ORM\Index(name="fk_expr_proj_idx", columns={"project_id"})})
 * @ORM\Entity
 */
class Experiments
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=450, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="date", nullable=false)
     */
    private $createDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Labor\BackendBundle\Entity\Projects
     *
     * @ORM\ManyToOne(targetEntity="Labor\BackendBundle\Entity\Projects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     * })
     */
    private $project;


}
