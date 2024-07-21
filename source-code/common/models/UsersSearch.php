<?php


namespace common\models;


use yii\data\ActiveDataProvider;

/**
 * Class UsersSearch
 * @package common\models
 */
class UsersSearch extends User
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'email','type'], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function scenarios(): array
    {
        return \yii\base\Model::scenarios();
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params): ActiveDataProvider
    {
        $query = User::find();
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]
        );

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $type = $this->type;
        if(strlen(trim($this->type))>0){
            $type = $this->getNumberType(strtolower(trim($this->type)));
        }

        $query->andFilterWhere(['like', 'username', $this->username])
        ->andFilterWhere(['like', 'email', $this->email])
        ->andFilterWhere(['like', 'id', $this->id])
        ->andFilterWhere(['like', 'type', $type]);

        return $dataProvider;
    }
}