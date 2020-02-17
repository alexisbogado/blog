<?php

/**
 * @author Alexis Bogado
 * @package blog
 * @version 1.0.0
 */

// Posts routes
$routes->get('/', 'PostsController@index')->name('posts');
$routes->get('/post', 'PostsController@post')->name('post');

// Users routes
$routes->get('/users', 'UsersController@index')->name('users');
$routes->get('/user', 'UsersController@user')->name('user');

// Registration routes
$routes->get('/register', 'UsersController@registationForm')->name('register');
$routes->post('/register', 'UsersController@register')->name('registration');
