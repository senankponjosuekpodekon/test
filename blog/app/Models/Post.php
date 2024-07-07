<?php

namespace App\Models;

use Illuminate\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Builder;



class Post extends Model
{
    use HasFactory;

    protected $with = [
        'category',
        // 'tags',
    ];


    //une méthode pour gérer l'affichage de l'url pour affiche l'article au lieu de l'id
    //route binding
    public function getRouteKeyName()
    {
        return 'slug';

    }

    public function scopeFilters(Builder $query, array $filters):void
    {
        if (isset($filters['search'])) {
            $query->where(fn(Builder $query)=> $query
            ->where('title','LIKE','%' . $filters['search'] . '%')
            ->orwhere('content','LIKE','%' . $filters['search'] . '%')
        );
        }

        if (isset($filters['category'])) {
            $query->where(
                'category_id', $filters['category']->id ?? $filters['category']
            );
        };

    }

    // protected function postsView(array $filters): View
    // {
    //     return view('posts.index', [
    //         'posts' => Post::filters($filters)->latest()->paginate(10),
    //     ]);
    // }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

} 
