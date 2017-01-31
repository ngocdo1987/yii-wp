<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tag;

/**
 * TagSearch represents the model behind the search form about `app\models\Tag`.
 */
class TagSearch extends Tag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tag_name', 'tag_slug', 'tag_description', 'tag_mt', 'tag_md', 'tag_mk', 'created_at', 'updated_at'], 'safe'],
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
        $query = Tag::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tag_name', $this->tag_name])
            ->andFilterWhere(['like', 'tag_slug', $this->tag_slug])
            ->andFilterWhere(['like', 'tag_description', $this->tag_description])
            ->andFilterWhere(['like', 'tag_mt', $this->tag_mt])
            ->andFilterWhere(['like', 'tag_md', $this->tag_md])
            ->andFilterWhere(['like', 'tag_mk', $this->tag_mk]);

        return $dataProvider;
    }
}
