<?php

namespace App\Blog\Application\Post\MakePost;

use App\Blog\Domain\Model\Post\PostRepository;
use App\Blog\Domain\Model\User\UserRepository;
use InvalidArgumentException;

class MakePostService
{
    private PostRepository $postRepository;
    private UserRepository $userRepository;

    public function __construct(PostRepository $postRepository, UserRepository $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function execute(MakePostRequest $request): void
    {
        $title = $request->getTitle();
        $content = $request->getContent();
        $authorId = $request->getAuthorId();
        $author = $this->userRepository->findById($authorId);

        if (!$author) {
            throw new InvalidArgumentException('Empty author');
        }

        $post = $author->makePost($this->postRepository->nextIdentity(), $title, $content);

        $this->postRepository->save($post);
    }
}
