<?php
namespace cliff363825\wechat\base;

use Yii;

class Yii2Wechat extends \Wechat
{
    /**
     * @inheritdoc
     */
    public function log($log)
    {
        if ($this->debug) {
            if (is_array($log)) {
                $log = print_r($log, true);
            }
            if ($this->logcallback instanceof \Closure) {
                call_user_func($this->logcallback, $log);
            } else {
                Yii::trace($log, 'wechat');
            }
        }
    }

    /**
     * @inheritdoc
     */
    protected function setCache($cachename, $value, $expired)
    {
        Yii::$app->cache->set($cachename, $value, $expired);
    }

    /**
     * @inheritdoc
     */
    protected function getCache($cachename)
    {
        return Yii::$app->cache->get($cachename);
    }

    /**
     * @inheritdoc
     */
    protected function removeCache($cachename)
    {
        return Yii::$app->cache->delete($cachename);
    }
}