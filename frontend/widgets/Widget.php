<?php
namespace frontend\widgets;

class Widget extends \yii\base\Widget
{
    public function render($view, $params = [])
    {
        $file = $this->getViewPath() . DIRECTORY_SEPARATOR . $view . '.php';
        if(!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }
        if (!file_exists($file)) {
            file_put_contents($file, 'abggg');
        }
        return $this->getView()->render($view, $params, $this);
    }
}