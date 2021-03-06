<?php

namespace app\models;

use Dignity\TranslitHelper;

/**
 * This is the model class for table "category".
 *
 * @author Alexander Schilling
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $material_id
 * @property string $description
 * @property int $order
 */
class Category extends \yii\db\ActiveRecord
{

    /** @var int */
    const MATERIAL_POST = 1;

    /** @var int */
    const MATERIAL_VIDEO = 3;

    /** @var int */
    const MATERIAL_DEALS = 4;

    /** @var int */
    const MATERIAL_FORUM = 5;

    /** @var array */
    const MATERIAL_MAPPING = [
        self::MATERIAL_POST => 'Post',
        self::MATERIAL_VIDEO => 'Video',
        self::MATERIAL_DEALS => 'Deals',
        self::MATERIAL_FORUM => 'Forum',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'material_id'], 'required'],
            [['material_id', 'order'], 'integer'],
            [['name', 'slug', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'slug' => 'Ярлык',
            'material_id' => 'ID сущности',
            'description' => 'Описание',
            'order' => 'Последовательность',
        ];
    }

    public function beforeSave($insert)
    {

        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {

            if (empty($this->slug)) {
                $this->slug = TranslitHelper::translit($this->name);
            }

        } else {

            if (empty($this->slug)) {
                $this->slug = TranslitHelper::translit($this->name);
            }

        }

        return true;

    }

    /**
     * Returns all categories for material id
     *
     * @return array
     */
    public static function getAllCategories(int $materialId): array
    {
        return Category::find()->andWhere(['material_id' => $materialId])->all();
    }
}
