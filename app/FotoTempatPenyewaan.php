<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Image;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FotoTempatPenyewaan extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = "foto_tempat_penyewaan";
    protected $guarded = [];
    protected $perPage = 5;

    public $registerMediaConversionsUsingModelInstance = true;
    const CONVERSION_THUMB = 'thumb';
    const CONVERSION_CAROUSEL_SLIDE = 'carousel-slide';
    const THUMB_MAX_WIDTH_PIXELS = 400;
    const CAROUSEL_MAX_WIDTH_PIXELS = 1110;

    public function registerMediaConversions(Media $media = null): void
    {
        $originalImage = Image::load($this->getFirstMediaPath());

        $this
            ->addMediaConversion(self::CONVERSION_THUMB)
            ->width(self::THUMB_MAX_WIDTH_PIXELS)
            ->height(self::THUMB_MAX_WIDTH_PIXELS / $originalImage->getWidth() * $originalImage->getHeight());

        $this
            ->addMediaConversion(self::CONVERSION_CAROUSEL_SLIDE)
            ->width(self::CAROUSEL_MAX_WIDTH_PIXELS)
            ->height(self::CAROUSEL_MAX_WIDTH_PIXELS / $originalImage->getWidth() * $originalImage->getHeight());
    }

    public function getCarouselPath()
    {
        return $this->getFirstMedia()
            ->getPath(self::CONVERSION_CAROUSEL_SLIDE);
    }

    public function getThumbPath()
    {
        return $this->getFirstMedia()
            ->getPath(self::CONVERSION_THUMB);
    }
}
