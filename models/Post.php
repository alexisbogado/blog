<?php

/**
 * @author Alexis Bogado
 * @package blog
 * @version 1.0.0
 */

namespace Models;

class Post
{
    public $id;
    public $userId;
    public $title;
    public $body;
    public $user;

    /**
     * Post class constructor
     *
     * @param int $id
     * @param string $title
     * @param string $body
     */
    public function __construct($id, $user_id, $title, $body)
    {
        $this->id = $id;
        $this->userId = $user_id;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Load post author
     * 
     * @return void
     */
    public function loadUser()
    {
        $data = api_call("https://gorest.co.in/public-api/users/{$this->userId}");
        if ($data->_meta->code != 200) return;

        $this->user = new User($data->result->id, $data->result->first_name, $data->result->last_name, $data->result->gender, $data->result->dob, $data->result->email, $data->result->phone, $data->result->website, $data->result->address, $data->result->status, $data->result->_links->avatar->href);
    }
}
