<?php
namespace peijunyang\wechat\base;

use Yii;
use yii\base\InvalidParamException;

/**
 * Class Component
 * @package peijunyang\wechat\base
 * @version 20150204
 */
class Component extends \yii\base\Component
{
    /**
     * 微信账号类型 common or qy
     * @var string
     */
    public $type = 'common';

    /**
     * 配置信息
     * @var array
     */
    public $config = [];

    /**
     * @var Yii2Wechat
     */
    private $_wechat;

    /**
     * @var Yii2ErrCode
     */
    private $_errCode;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->classMap();
    }

    /**
     * 映射类库
     */
    public function classMap()
    {
        switch ($this->type) {
            case 'qy':
                Yii::$classMap['Wechat'] = realpath(__DIR__ . '/../sdk/qywechat.class.php');
                Yii::$classMap['ErrCode'] = realpath(__DIR__ . '/../sdk/qyerrCode.php');
                break;
            case 'common':
                Yii::$classMap['Wechat'] = realpath(__DIR__ . '/../sdk/wechat.class.php');
                Yii::$classMap['ErrCode'] = realpath(__DIR__ . '/../sdk/errCode.php');
                break;
            default:
                throw new InvalidParamException('Unknown wechat type.');
        }
    }

    /**
     * 获取Yii2Wechat对象
     * @return Yii2Wechat
     */
    public function getWechat()
    {
        if ($this->_wechat === null) {
            $this->_wechat = new Yii2Wechat($this->config);
        }
        return $this->_wechat;
    }

    /**
     * 获取Yii2ErrCode对象
     * @return Yii2ErrCode
     */
    public function getErrCode()
    {
        if ($this->_errCode === null) {
            $this->_errCode = new Yii2ErrCode();
        }
        return $this->_errCode;
    }
}