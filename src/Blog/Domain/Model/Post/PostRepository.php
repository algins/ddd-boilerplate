<?php

namespace App\Blog\Domain\Model\Post;

interface PostRepository
{
    public function findAll(): array;

    public function findById(string $id): ?Post;

    public function save(Post $post): void;

    public function nextIdentity(): PostId;
}
