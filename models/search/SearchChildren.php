<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Children;

/**
 * SearchChildren represents the model behind the search form of `app\models\Children`.
 */
class SearchChildren extends Children
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ChildId', 'ParentId'], 'integer'],
            [['FirstName', 'LastName', 'DateOfBirth'], 'safe'],
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
        $query = Children::find();

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
            'ChildId' => $this->ChildId,
            'DateOfBirth' => $this->DateOfBirth,
            'ParentId' => $this->ParentId,
        ]);

        $query->andFilterWhere(['like', 'FirstName', $this->FirstName])
            ->andFilterWhere(['like', 'LastName', $this->LastName]);

        return $dataProvider;
    }
}
