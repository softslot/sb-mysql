<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'post_tag')]
class PostTag
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'postTags')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Post $post;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Tag::class, inversedBy: 'postTags')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Tag $tag;

    public function __construct(Post $post, Tag $tag)
    {
        $this->post = $post;
        $this->tag = $tag;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function getTag(): Tag
    {
        return $this->tag;
    }
}
