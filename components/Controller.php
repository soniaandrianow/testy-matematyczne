<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 27.11.2017
 * Time: 12:51
 */
namespace app\components;
use Yii;
use yii\web\Controller as YiiController;
/**
 * Controller extended.
 *
 */
class Controller extends YiiController
{
    use FlashTrait;
    /**
     * Short for Yii::$app->request->post().
     * @param string $name the parameter name
     * @param mixed $defaultValue the default parameter value if the parameter does not exist.
     * @return array|mixed
     */
    public function post($name = null, $defaultValue = null)
    {
        return Yii::$app->request->post($name, $defaultValue);
    }
    /**
     * Short for Yii::$app->request->get().
     * @param string $name the parameter name
     * @param mixed $defaultValue the default parameter value if the parameter does not exist.
     * @return array|mixed
     */
    public function get($name = null, $defaultValue = null)
    {
        return Yii::$app->request->get($name, $defaultValue);
    }
    /**
     * Short for Yii::$app->request->isAjax.
     * @return boolean
     */
    public function isAjax()
    {
        return Yii::$app->request->isAjax;
    }
    /**
     * Short for Yii::$app->request->isPost.
     * @return boolean
     */
    public function isPost()
    {
        return Yii::$app->request->isPost;
    }
    /**
     * Short for Yii::$app->request->isGet.
     * @return boolean
     */
    public function isGet()
    {
        return Yii::$app->request->isGet;
    }

    /**
     * Checking if user is using ipad or iphone.
     * @return boolean
     */
    public function isIOS()
    {
        $isIOS = false;
        $userAgent = Yii::$app->request->userAgent;
        if ($userAgent) {
            $ipad = strstr($userAgent, 'iPad');
            $iphone = strstr($userAgent, 'iPhone');
            $isIOS = $ipad || $iphone;
        }
        return $isIOS;
    }
}