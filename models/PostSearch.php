<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\models\Post`.
 *
 * @author Alexander Schilling
 */
class PostSearch extends Post
{

    public $tagId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'datecreate', 'dateupdate', 'category_id', 'user_id', 'hits', 'ontop'], 'integer'],
            [['title', 'content', 'tags', 'allow_comments', 'meta_keywords', 'meta_description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find()->orderBy('datecreate DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'id'          => $this->id,
                'status_id'   => $this->status_id,
                'user_id'     => $this->user_id,
                'ontop'       => $this->ontop,
            ]
        );

        $query->andFilterWhere(['like', 'title', $this->title]);

        // Filter by tag id

        if (!$this->tagId) {
            $query->with(['tags']);
        } else {
            $query->joinWith(['tags']);
            $query->andWhere(['post_tags.tag_id' => $this->tagId]);
        }

        return $dataProvider;
    }
}
