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
    protected $filters = ['tag', 'year', 'month', 'search'];

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
}
