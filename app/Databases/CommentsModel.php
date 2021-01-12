<?php

namespace App\Databases;


use Jenssegers\Mongodb\Eloquent\Model;

class CommentsModel extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'comments';

    public static function getCommentsData($noticias)
    {
        try {
            foreach ($noticias as $noticia) {
                $comments = self::where('storyID', $noticia->coral_id)->where('siteID', env('CORAL_SITE_ID', '550c03dd-d44a-4a3c-bd04-a8694facd564'))->count();
                $respect = self::where('storyID', $noticia->coral_id)->where('siteID', env('CORAL_SITE_ID', '550c03dd-d44a-4a3c-bd04-a8694facd564'))->sum('actionCounts.REACTION');
                $noticia->comments = $comments;
                $noticia->respect = $respect;
            }
        } catch (\Exception $error) {
            foreach ($noticias as $noticia) {
                $noticia->comments = 0;
                $noticia->respect = 0;
            }
        }
        return $noticias;
    }

}

