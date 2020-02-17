<?php

/**
 * @author Alexis Bogado
 * @package blog
 * @version 1.0.0
 */

namespace Models;

class User
{
    public $id;
    public $firstName;
    public $lastName;
    public $gender;
    public $dob;
    public $email;
    public $phone;
    public $website;
    public $address;
    public $status;
    public $avatar;
    public $posts;

    /**
     * User class constructor
     *
     * @param int $id
     * @param string $first_name
     * @param string $last_name
     * @param string $gender
     * @param string $dob
     * @param string $email
     * @param string $phone
     * @param string $website
     * @param string $address
     * @param string $status
     * @param string $avatar
     */
    public function __construct($id, $first_name, $last_name, $gender, $dob, $email, $phone, $website, $address, $status, $avatar)
    {
        $this->id = $id;
        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->gender = $gender;
        $this->dob = $dob;
        $this->email = $email;
        $this->phone = $phone;
        $this->website = $website;
        $this->address = $address;
        $this->status = $status;
        $this->avatar = $avatar;
        $this->posts = [ ];
    }

    /**
     * Get user full name
     *
     * @return string
     */
    public function fullName()
    {
        return "{$this->firstName} {$this->lastName}";
    }

    /**
     * Load all user posts
     * 
     * @param int $page
     *
     * @return object
     */
    public function loadPosts($page)
    {
        $data = api_call("https://gorest.co.in/public-api/posts?user_id={$this->id}&page={$page}");
        if ($data->_meta->code != 200) return;

        foreach ($data->result as $post)
            $this->posts[] = new Post($post->id, $post->user_id, $post->title, $post->body);

        return $data;
    }
}
