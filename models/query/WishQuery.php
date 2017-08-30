<?php
/**
 * This file is part of Yii2-Wishmaker project
 * (c) kirillantv <http://github.com/kirillantv/>
 * 
 * For more information read README and LICENSE file 
 */
 
namespace kirillantv\wishmaker\models\query;

class WishQuery extends \yii\db\ActiveQuery
{
	public function user($user)
	{
		return $this->where(['user_id' => $user]);
	}

    public function all($db = null)
    {
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }
}