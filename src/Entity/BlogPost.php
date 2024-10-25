<?php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
class BlogPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 99999)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable(on: "create")]
    private ?\DateTimeInterface $created_on = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable(on: "update")]
    private ?\DateTimeInterface $updated_on = null;

    /**
     * Constructor to initialize the created_on and updated_on fields.
     * Sets the current date and time in the CAT time zone.
     */
    public function __construct()
    {
        // Define the time zone for Central Africa Time (CAT)
        $timezone = new \DateTimeZone('Africa/Johannesburg'); // or 'Africa/Gaborone'
        
        // Initialize created_on and updated_on to the current date and time in CAT
        $this->created_on = new \DateTime('now', $timezone);
        $this->updated_on = new \DateTime('now', $timezone);
    }

    /**
     * Get the ID of the blog post.
     *
     * @return int|null The ID of the blog post
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the ID of the blog post (usually not needed, as it's auto-generated).
     *
     * @param int $id The ID to set
     * @return static
     */
    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the title of the blog post.
     *
     * @return string|null The title of the blog post
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the title of the blog post and update the updated_on field.
     * Updates the updated_on timestamp to the current date and time in CAT.
     *
     * @param string $title The title to set
     * @return static
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

        // Update updated_on to the current date and time in CAT whenever the title is changed
        $timezone = new \DateTimeZone('Africa/Johannesburg'); // or 'Africa/Gaborone'
        $this->updated_on = new \DateTime('now', $timezone);

        return $this;
    }

    /**
     * Get the content of the blog post.
     *
     * @return string|null The content of the blog post
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set the content of the blog post and update the updated_on field.
     * Updates the updated_on timestamp to the current date and time in CAT.
     *
     * @param string $content The content to set
     * @return static
     */
    public function setContent(string $content): static
    {
        $this->content = $content;

        // Update updated_on to the current date and time in CAT whenever the content is changed
        $timezone = new \DateTimeZone('Africa/Johannesburg'); // or 'Africa/Gaborone'
        $this->updated_on = new \DateTime('now', $timezone);

        return $this;
    }

    /**
     * Get the creation date and time of the blog post.
     *
     * @return \DateTimeInterface|null The creation date and time
     */
    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->created_on;
    }

    /**
     * Set the creation date and time of the blog post (not typically used after creation).
     *
     * @param \DateTimeInterface $created_on The creation date and time to set
     * @return static
     */
    public function setCreatedOn(\DateTimeInterface $created_on): static
    {
        $this->created_on = $created_on;
        return $this;
    }

    /**
     * Get the last updated date and time of the blog post.
     *
     * @return \DateTimeInterface|null The last updated date and time
     */
    public function getUpdatedOn(): ?\DateTimeInterface
    {
        return $this->updated_on;
    }

    /**
     * Set the last updated date and time of the blog post (optional).
     *
     * @param \DateTimeInterface $updated_on The updated date and time to set
     * @return static
     */
    public function setUpdatedOn(\DateTimeInterface $updated_on): static
    {
        $this->updated_on = $updated_on;
        return $this;
    }
}