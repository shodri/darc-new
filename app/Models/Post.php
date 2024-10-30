<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['title', 'excerpt', 'body', 'user_id', 'category_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->excerpt)) {
                $post->excerpt = Str::limit(strip_tags($post->body), 200); // Ajusta la longitud según tus necesidades
            }
        });

        static::updating(function ($post) {
            if (empty($post->excerpt)) {
                $post->excerpt = Str::limit(strip_tags($post->body), 200); // Ajusta la longitud según tus necesidades
            }
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->format(Manipulations::FORMAT_WEBP)
              ->width(80)
              ->height(60)
              ->sharpen(10);
        $this->addMediaConversion('webp')
            ->format(Manipulations::FORMAT_WEBP)
            ->nonQueued();
        // $this->addMediaConversion('old-picture')
        //       ->sepia()
        //       ->border(10, 'black', Manipulations::BORDER_OVERLAY);
    }

    public function shouldPerformOptimization(Media $media): bool
    {
        // Aquí puedes implementar lógica para excluir ciertos medios de la optimización
        return false; // Puedes ajustar esta lógica según tus necesidades
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
