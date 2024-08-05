<?php

namespace App\Exceptions;

use App\Models\Post;
use App\Services\LogToFileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class PostException extends Exception
{
    protected Post|null $post;

    /**
     * @param string         $message
     * @param int            $code
     * @param Post|null      $post
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Post $post = null, Throwable $previous = null)
    {
        $this->post = $post ?? null;

        parent::__construct($message, $code, $previous);
    }

    public function report(): void
    {
        if ($this->post) {
            LogToFileService::addLog(
                $this->post,
                $this->message
            );
        }
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function render(Request $request): Response
    {
        return response(
            [
                'message' => $this->message
            ],
            Response::HTTP_OK
        );
    }

    /**
     * @param Post $post
     *
     * @throws PostException
     */
    public static function checkWasRecentlyCreated(Post $post, string $message)
    {
        if ($post->wasRecentlyCreated) {
            throw new self(
                $message,
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $post
            );
        }
    }
}
