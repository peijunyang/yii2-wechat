<?php
namespace cliff363825\wechat\base;

use Yii;

/**
 * Class Component
 * @package cliff363825\wechat\base
 * @version 20150204
 */
class Component extends \yii\base\Component
{
    /**
     * 微信公众号类型 common or qy
     * @var string
     */
    public $type = 'common';

    /**
     * 配置信息
     * @var array
     */
    public $config = [];

    /**
     * @var \Wechat
     */
    private $_wechat;

    /**
     * @var \ErrCode
     */
    private $_errCode;

    /**
     * 是否初始化
     * @var bool
     */
    private $_initialized = false;

    /**
     * 映射类库
     */
    public function classMap()
    {
        if ($this->_initialized === false) {
            $this->_initialized = true;
            switch ($this->type) {
                case 'qy':
                    Yii::$classMap['Wechat'] = '@cliff363825/wechat/sdk/qywechat.class.php';
                    Yii::$classMap['ErrCode'] = '@cliff363825/wechat/sdk/qyerrCode.php';
                    break;
                case 'common':
                default:
                    Yii::$classMap['Wechat'] = '@cliff363825/wechat/sdk/wechat.class.php';
                    Yii::$classMap['ErrCode'] = '@cliff363825/wechat/sdk/errCode.php';
                    break;
            }
        }
    }

    /**
     * 获取Wechat对象
     * @return \Wechat
     */
    public function getWechat()
    {
        if ($this->_wechat === null) {
            $this->classMap();
            $this->_wechat = new Yii2Wechat($this->config);
        }
        return $this->_wechat;
    }

    /**
     * 获取ErrCode对象
     * @return \ErrCode
     */
    public function getErrCode()
    {
        if ($this->_errCode === null) {
            $this->classMap();
            $this->_errCode = new \ErrCode();
        }
        return $this->_errCode;
    }
}