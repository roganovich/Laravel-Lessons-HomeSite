<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{
    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }
    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    public function updating(BlogPost $blogPost){
        //dd($blogPost);
        //$blogPost->isDirty(); // была ли изменина модель.
        //$blogPost->isDirty('title') //было ли изменено поле title
        //$blogPost->title; //Достать атрибут модели после получения новых атрибутов
        //$blogPost->getAttribute('title'); //Достать атрибут модели после получения новых атрибутов
        //$blogPost->getOriginal('title'); //Достать атрибут модели до получения новых атрибутов
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }
    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }

    public function setPublishedAt(BlogPost $blogPost){
        if(empty($blogPost->published_at) && $blogPost->is_published){
            $blogPost->published_at = Carbon::now();
        }
    }

    public function setSlug(BlogPost $blogPost){
        if(empty($blogPost->slug)){
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }

    public function setHtml(BlogPost $blogPost) {
        if ($blogPost->isDirty('content_raw')) {
            //Доделать генерацию
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    public function setUser(BlogPost $blogPost){
        if($blogPost->isDirty('user_id')){
            //Доделать авторизацию
            //$blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
        }
    }

}
