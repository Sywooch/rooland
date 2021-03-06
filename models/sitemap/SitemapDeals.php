<?php

namespace app\models\sitemap;

use yii\helpers\Url;
use app\models\Deals;
use demi\sitemap\interfaces\Basic;

/**
 * Class SitemapDeals
 *
 * @author Alexander Schilling
 *
 * @package app\models\sitemap
 */
class SitemapDeals extends Deals implements Basic
{

    /**
     * @inheritdoc
     */
    public function getSitemapItems($lang = null)
    {
        return [
            // deals/index
            [
                'loc'        => Url::to(['/deals/index']),
                'lastmod'    => time(),
                'changefreq' => static::CHANGEFREQ_DAILY,
                'priority'   => static::PRIORITY_10
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSitemapItemsQuery($lang = null)
    {
        return static::find()
            ->select(['title', 'created', 'id'])
            ->where(['status_id' => Deals::STATUS_PUBLIC])
            ->orderBy(['created' => SORT_DESC]);
    }

    /**
     * @inheritdoc
     */
    public function getSitemapLoc($lang = null)
    {
        return Url::to(['/deals/view', 'id' => $this->id], true);
    }

    /**
     * @inheritdoc
     */
    public function getSitemapLastmod($lang = null)
    {
        return $this->created;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapChangefreq($lang = null)
    {
        return static::CHANGEFREQ_MONTHLY;
    }

    /**
     * @inheritdoc
     */
    public function getSitemapPriority($lang = null)
    {
        return static::PRIORITY_8;
    }
}
