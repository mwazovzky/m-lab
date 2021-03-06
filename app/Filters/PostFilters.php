<?php

namespace App\Filters;

use Carbon\Carbon;

class PostFilters extends Filters
{
    /**
     * List of available filters for the model
     *
     * @var array of strings
     */
    protected $filters = ['id', 'tag', 'year', 'month', 'search', 'limit', 'popular', 'favorite'];

    /**
     * Filters posts by id.
     * Used by API
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function id($value)
    {
        $this->builder->whereId($value);
    }

    /**
     * Filters posts by tag.
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function tag($value)
    {
        $this->builder->whereHas('tags', function ($query) use ($value) {
            return $query->whereName($value);
        });
    }


    /**
     * Filters posts by year.
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function year($value)
    {
        $this->builder->whereYear('created_at', $value);
    }

    /**
     * Filters posts by month.
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function month($value)
    {
        $this->builder->whereMonth('created_at', Carbon::parse($value)->month);
    }

    /**
     * Filters posts by search string.
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function search($value)
    {
        $this->builder
            ->where('title', 'LIKE', "%{$value}%")
            ->orWhere('body', 'LIKE', "%{$value}%");
    }

    /**
     * Limit the number of return posts.
     *
     * @param integer $limit
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function limit($limit)
    {
        $this->builder->take($limit);
    }

    /**
     * Sorts posts by popularity - views count.
     *
     * @param integer $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function popular($value = 'DESC')
    {
        $order = ($value === 'ASC' || $value === 'asc') ? 'ASC' : 'DESC';

        $this->builder->orderBy('views', $order);
    }

    /**
     * Filters posts favorited by authenticated user.
     *
     * @param string $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function favorite($value = null)
    {
        $user = auth()->user();

        if (!$user) {
            return $this->builder;
        }

        $this->builder->whereHas('favorites', function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        });
    }
}
