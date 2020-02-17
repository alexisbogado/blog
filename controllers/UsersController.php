<?php

/**
 * @author Alexis Bogado
 * @package blog
 * @version 1.0.0
 */

namespace Controllers;

use Models\User;

class UsersController
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
        $users_request = api_call("https://gorest.co.in/public-api/users?page={$requested_page}");
        $users = [ ];

        if ($users_request->_meta->code == 200)
            foreach ($users_request->result as $user)
                $users[] = $this->loadUser($user);

        return view('users', [
            'description' => 'Lista de usuarios',
            'users' => $users,
            'page_count' => $users_request->_meta->pageCount,
            'current_page' => $users_request->_meta->currentPage,
            'previous_page' => ($users_request->_meta->currentPage - 1),
            'next_page' => ($users_request->_meta->currentPage + 1)
        ]);
    }

    /**
     * Show requested post
     *
     * @param object $request
     * 
     * @return Core\ViewManager
     */
    public function user($request)
    {
        $user_id = ($request->input->id ?? 1);
        $user_request = api_call("https://gorest.co.in/public-api/users/{$user_id}");

        if ($user_request->_meta->code != 200)
            return view('user', [
                'error' => true
            ]);
        
        
        $requested_page = ($request->input->page ?? 1);
        $user = $this->loadUser($user_request->result);
        $user_posts = $user->loadPosts($requested_page);

        return view('user', [
            'description' => $user->fullName(),
            'user' => $user,
            'page_count' => $user_posts->_meta->pageCount,
            'current_page' => $user_posts->_meta->currentPage,
            'previous_page' => ($user_posts->_meta->currentPage - 1),
            'next_page' => ($user_posts->_meta->currentPage + 1)
        ]);
    }

    /**
     * Render registration form
     *
     * @param object $request
     * 
     * @return Core\ViewManager
     */
    public function registationForm($request)
    {
        return view('registration', [
            'description' => 'Nuevo usuario'
        ]);
    }

    public function register($request)
    {
        $register_request = api_call("https://gorest.co.in/public-api/users", $request->input);
        $errors = [ ];

        if ($register_request->_meta->success):
            $user = $this->loadUser($register_request->result);
            return view('registration', [
                'description' => 'Nuevo usuario',
                'success' => true,
                'user' => $user
            ]);
        endif;
        
        foreach ($register_request->result as $error)
            $errors[$error->field] = $error->message;

        return view('registration', [
            'description' => 'Nuevo usuario',
            'errors' => $errors
        ]);
    }

    /**
     * Create a new user instance from passed data
     *
     * @param array $data
     * 
     * @return Models\User
     */
    private function loadUser($data)
    {
        return new User($data->id, $data->first_name, $data->last_name, $data->gender, $data->dob, $data->email, $data->phone, $data->website, $data->address, $data->status, $data->_links->avatar->href);
    }
}
