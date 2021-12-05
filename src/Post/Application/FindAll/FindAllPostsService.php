<?php

namespace App\Post\Application\FindAll;

use App\Post\Application\PostResponse;
use App\Post\Domain\PostRepository;

class FindAllPostsService
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(): array
    {
        $posts = $this->postRepository->findAll();

        return array_map(function ($post) {
            return new PostResponse($post);
        }, $posts);
    }
}
