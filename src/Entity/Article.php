<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(length=15) */
    private $name;

    /** @ORM\Column(type="text") */
    private $content;

    /**
     *  Many Articles have One Category
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Category",
     *     cascade={"persist"}
     * )
     */
    private $category;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
    /**
     * @return Collection|Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }


    /**
     * Many Articles have Many Tags.
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles", cascade={"persist"})
     */
    private $tags = [];

    public function addTag(Tag $tag)
    {
        $tag->addArticle($this);
        $this->tags[] = $tag;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

}
