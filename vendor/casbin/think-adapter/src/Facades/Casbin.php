<?php

namespace CasbinAdapter\Think\Facades;

use think\Facade;
use think\Container;
use Casbin\Enforcer;
use Casbin\Model\Model;

/**
 * Class Casbin
 * @package CasbinAdapter\Think\Facades
 * @method bool|mixed enforce(mixed ... $rvals) static 说明
 */
class Casbin extends Facade
{
    protected static function getFacadeClass()
    {
        if (!Container::getInstance()->has('casbin')) {
            Container::getInstance()->bindTo('casbin', function () {
                $adapter = config('casbin.adapter');

                $configType = config('casbin.model.config_type');

                $model = new Model();
                if ('file' == $configType) {
                    $model->loadModel(config('casbin.model.config_file_path'));
                } elseif ('text' == $configType) {
                    $model->loadModel(config('casbin.model.config_text'));
                }

                return new Enforcer($model, app($adapter));
            });
        }

        return 'casbin';
    }
}
