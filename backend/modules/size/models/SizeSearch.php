<?php

namespace backend\modules\size\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\size\models\Size;

/**
 * SizeSearch represents the model behind the search form about `backend\modules\size\models\Size`.
 */
class SizeSearch extends Size
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_activated', 'is_deleted', 'created_by', 'updated_by'], 'integer'],
            [['size_name', 'created_date', 'updated_date'], 'safe'],
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
        $query = Size::find();

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
            'is_activated' => $this->is_activated,
            'is_deleted' => 0,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'size_name', $this->size_name]);

        return $dataProvider;
    }
}
