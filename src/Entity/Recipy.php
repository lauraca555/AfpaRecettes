<?php

namespace App\Entity;


use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=RecipyRepository::class)
 * @ORM\Entity
 * @Vich\Uploadable
 * @UniqueEntity("title", message="Ce nom de recette existe déjà.")
 * @ApiResource(
 *  normalizationContext = {
 *      "groups" = {"read:recette"}
 *   },
 *  collectionOperations={"get"},
 *  itemOperations={"get"}
 * )
 */
class Recipy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:recette"})
     */
    private $id;

    /**
     * @Assert\NotBlank(message = "La titre ne peut pas être vide.")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le titre doit contenir au minimum {{ limit }} caractères.",
     *      maxMessage = "Le titre doit contenir au maximum  {{ limit }} caractères.",
     *      allowEmptyString = false
     * )
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:recette"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resumer;

    /**
     * @Assert\NotBlank(message = "Indiquez le temps necessaire.")
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:recette"})
     */
    private $temps;

    /**
     * @Assert\NotBlank(message = "Renseigner la preparation.")
     * @ORM\Column(type="text")
     * @Groups({"read:recette"})
     */
    private $preparation;

    /**
     * @Assert\NotBlank(message = "Donnez le nombre de convives.")
     * @Assert\Range(
     *      min = 1,
     *      max = 6,
     *      notInRangeMessage = "Le nombre de personnes doit être comprise entre {{ min }}et  {{ max }}",
     * )
     * @ORM\Column(type="integer")
     * @Groups({"read:recette"})
     */
    private $convives;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAd;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="recipies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

     /**
     *
     * @Vich\UploadableField(mapping="recette_image", fileNameProperty="imageName")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recipies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;
    
    public function __construct(){
        $this->createdAd= new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getResumer(): ?string
    {
        return $this->resumer;
    }

    public function setResumer(?string $resumer): self
    {
        $this->resumer = $resumer;

        return $this;
    }

    public function getTemps(): ?string
    {
        return $this->temps;
    }

    public function setTemps(string $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getConvives(): ?int
    {
        return $this->convives;
    }

    public function setConvives(int $convives): self
    {
        $this->convives = $convives;

        return $this;
    }

    public function getCreatedAd(): ?\DateTimeInterface
    {
        return $this->createdAd;
    }

    public function setCreatedAd(\DateTimeInterface $createdAd): self
    {
        $this->createdAd = $createdAd;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

     /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
