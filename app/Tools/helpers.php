<?php

use App\Post;

/**
 * Flash message to the session
 *
 * @param string|null $title
 * @param string|null $message
 * @return App\Tools\Flash
 */
function flash($message = null)
{
    $flash = app('App\Tools\Flash');

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->success($message);
}

/**
 * Get post form input value
 *
 * @param string $key
 * @param App\Model $model
 * @return mixed
 */
function getValue($key, $model = null)
{
    return old($key) ?: (isset($model) ? $model->$key : null);
}

/**
 * Highlight matching substring.
 *
 * @param string $search
 * @param string $subject
 * @return string
 */
function highlight(string $search, string $subject)
{
    $replace = "<span class=\"highlight\">{$search}</span>";

    return str_replace($search, $replace, $subject);
}

/**
 * Check scout search engine driver.
 *
 * @return string
 */
function searchEngine()
{
    return config('scout.driver');
}

/**
 * Counts number of posts per tag
 * without using tag->posts relationship
 *
 * @return array of ['tagName' => $count, ...] items
 */
function tagCounts($key = null)
{
    $data = array_count_values(
        Post::all()->flatMap(function ($post) {
            return $post->tags()->pluck('name');
        })->all()
    );

    return $key && isset($data[$key]) ? $data[$key] : $data;
}
