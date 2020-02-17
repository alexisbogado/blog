<?php

/**
 * @author Alexis Bogado
 * @package blog
 * @version 1.0.0
 */

namespace Controllers;

use Models\Post;

class PostsController
{
    /**
     * Show post list view
     *
     * @param object $request
     * 
     * @return Core\ViewManager
     */
    public function index($request)
    {
        $requested_page = ($request->input->page ?? 1);
        $posts_request = api_call("https://gorest.co.in/public-api/posts?page={$requested_page}");
        $posts = [ ];

        if ($posts_request->_meta->code == 200)
            foreach ($posts_request->result as $post)
                $posts[] = $this->loadPost($post);

        return view('posts', [
            'description' => 'Lista de posts',
            'posts' => $posts,
            'page_count' => $posts_request->_meta->pageCount,
            'current_page' => $posts_request->_meta->currentPage,
            'previous_page' => ($posts_request->_meta->currentPage - 1),
            'next_page' => ($posts_request->_meta->currentPage + 1)
        ]);
    }

    /**
     * Show requested post
     *
     * @param object $request
     * 
     * @return Core\ViewManager
     */
    public function post($request)
    {
        $post_id = ($request->input->id ?? 1);
        $posts_request = api_call("https://gorest.co.in/public-api/posts/{$post_id}");

        if ($posts_request->_meta->code != 200)
            return view('post', [
                'error' => true
            ]);
        
        $post = $this->loadPost($posts_request->result);
        $post->loadUser();

        return view('post', [
            'description' => $post->title,
            'post' => $post
        ]);
    }

    /**
     * Create a new post instance from passed data
     *
     * @param array $data
     * 
     * @return Models\Post
     */
    private function loadPost($data)
    {
        return new Post($data->id, $data->user_id, $data->title, $data->body);
    }
}
