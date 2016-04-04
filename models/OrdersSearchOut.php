<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `app\models\Orders`.
 */
class OrdersSearchOut extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'employee_id', 'department_id'], 'integer'],
            [['comment'], 'safe'],
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
        //$query = Orders::find()->joinWith('events')->orderBy('events.event_id')->where(['events.status_id'=>1]);

        //$employees = Employees::find()->select(['employees_id'])->where(['department_id'=>Employees::findOne(Yii::$app->user->id)->department_id])->asArray();
        
        //$query = Orders::find()->where(['department_id'=>Employees::findOne(Yii::$app->user->id)->department_id, 'status'=>1]);
        
        $subquery = Employees::find()
            ->select('employee_id')
            ->where(['department_id'=>Employees::findOne(Yii::$app->user->id)->department_id]);

        $query = Orders::find()
            ->where(['in','employee_id',$subquery])
            ->where(['status'=>1]);
            
        
        
        
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
/*
        // grid filtering conditions
        $query->andFilterWhere([
            'order_id' => $this->order_id,
            'employee_id' => $this->employee_id,
            'department_id' => $this->department_id,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);
*/
        return $dataProvider;
    }
}
