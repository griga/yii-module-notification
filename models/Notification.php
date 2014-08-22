<?php

/**
 * This is the model class for table "{{notification}}".
 *
 * The followings are the available columns in table '{{notification}}':
 * @property integer $id
 * @property string $subject
 * @property string $message
 * @property integer $type
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 * @property integer $user_id
 */
class Notification extends CActiveRecord
{
    const TYPE_CONTACT_REQUEST = 1;

    const STATUS_NEW = 0;
    const STATUS_PROCESSED = 1;


    public static function getTypes(){
        return [
            self::TYPE_CONTACT_REQUEST => t('Contact request'),
        ];
    }

    public function getTypeName(){
        $types = self::getTypes();
        return $types[$this->type];
    }

    public static function getStatuses(){
        return [
            self::STATUS_NEW => t('New notification'),
            self::STATUS_PROCESSED => t('Processed notification'),
        ];
    }

    public function getStatusName(){
        $statuses = self::getStatuses();
        return $statuses[$this->status];
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{notification}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, message, type', 'required'),
			array('type, status, user_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>250),
			array('create_time, update_time', 'safe'),
			array('id, subject, message, type, status, create_time, update_time, user_id', 'safe', 'on'=>'search'),
		);
	}

    /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => 'Subject',
			'message' => 'Message',
			'type' => 'Type',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'user_id' => 'User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * return behaviors of component merged with parent component behaviors
     * @return array CBehavior[]
     */

    public function behaviors(){
    	return CMap::mergeArray(
    		parent::behaviors(),
    		array(
                'CTimestampBehavior' => [
                    'class' => 'zii.behaviors.CTimestampBehavior',
                    'setUpdateOnCreate'=>true,
                ],
    	));
    }
}
