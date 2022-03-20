<?php

namespace app\models;


use yii\db\ActiveRecord;

class Author extends ActiveRecord
{
    public static function tableName()
    {
        return '{{author}}';
    }

    public function getUsername($id)
    {
        $result = Author::find()
            ->select('username')
            ->where(['id' => $id])
            ->one();

        return $result->username;
    }

    public function getContacts($id)
    {
        $result = Author::find()
            ->select('id, username, email, phone')
            ->where(['id' => $id])
            ->one();

        return $result;
    }
}