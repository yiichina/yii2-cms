<?php

namespace backend\widgets;

use yii\bootstrap\ButtonDropdown;
use yii\helpers\Html;
use yiichina\icons\Icon;
use yiichina\icheck\ICheckAsset;
use yii\helpers\Url;

use Yii;

class GridView extends \yii\grid\GridView
{
	public $batchItems = false;
	public $button = false;
    public $layout = "<div class=\"grid-tool\">{batch}<div class=\"pull-right\"><div class=\"btn-toolbar\">{size}{button}</div></div></div>\n{items}\n{summary}<div class=\"pull-right\">{pager}\n</div>";
	
	/**
     * Initializes the grid view.
     * This method will initialize required property values and instantiate [[columns]] objects.
     */
    public function init()
    {
		parent::init();
        $view = $this->getView();
        $asset = ICheckAsset::register($view);
        $view->registerCssFile($asset->baseUrl . '/skins/minimal/blue.css');
        $view->registerJs("$('#{$this->options['id']} input[type=\"checkbox\"]').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue',
        }).on('ifChanged', function(event) {
            var array =  $('#{$this->options['id']} input[name=\"selection[]\"]:checked').map(function(){
                return this.value;
            }).get();
            var obj = {};
            obj.ids = array;
            var ids = JSON.stringify(obj);
            $('#{$this->options['id']}-batch a').each(function () {
                $(this).attr('data-params', ids);
            });
        });
        $('#{$this->options['id']} input[name=\"selection_all\"]').on('ifToggled', function (event) {
            var chkToggle;
            $(this).is(':checked') ? chkToggle = \"check\" : chkToggle = \"uncheck\";
            $('#{$this->options['id']} input[name=\"selection[]\"]').iCheck(chkToggle);
        });");

        $this->pager['hideOnSinglePage'] = false;
	}

    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{summary}`, `{items}`.
     * @return string|bool the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSection($name)
    {
        $result = parent::renderSection($name);
        if($result === false) {
            switch ($name) {
                case '{batch}':
                    return $this->renderBatch();
                case '{size}':
                    return $this->renderSize();
                case '{button}':
                    return $this->renderButton();
                default:
                    return false;
            }
        }
        return $result;
    }
    
    protected function renderBatch()
    {
        $id = $this->options['id'] . '-batch';
        $items = array_map(function($value){
            $value['linkOptions']['data'] = [
                'method' => 'post',
                'confirm' => '您确定要对选择的条目批量' . $value['label'] . '吗？',
            ];
            return $value;
        }, $this->batchItems);
        return ButtonDropdown::widget([
            'label' => Icon::show('cog', 'fa') . '批量操作',
            'options' => ['class' => 'btn-sm btn-flat btn-warning'],
            'encodeLabel' => false,
            'dropdown' => [
                'items' => $items,
                'options' => ['id' => $id],
            ],
        ]);
    }

    protected function renderSize()
    {
        $pagination = $this->dataProvider->pagination;
        $params = Yii::$app->request->getQueryParams();
        $params[0] = Yii::$app->controller->getRoute();
        $pageSizeParam = $pagination->pageSizeParam;
        $items = [
            ['label' => '每页显示 10 条', 'url' => Url::to(array_merge($params, [$pageSizeParam => 10]))],
            ['label' => '每页显示 20 条', 'url' => Url::to(array_merge($params, [$pageSizeParam => 20]))],
            ['label' => '每页显示 50 条', 'url' => Url::to(array_merge($params, [$pageSizeParam => 50]))],
            ['label' => '每页显示 100 条', 'url' => Url::to(array_merge($params, [$pageSizeParam => 100]))],
        ];
        return ButtonDropdown::widget([
            'label' => Icon::show('list', 'fa') . "每页显示 <b>{$pagination->pageSize}</b> 条",
            'options' => ['class' => 'btn-sm btn-flat btn-primary'],
            'containerOptions' => ['role' => 'group'],
            'encodeLabel' => false,
            'dropdown' => [
                'items' => $items,
            ],
        ]); 
    }

    protected function renderButton()
    {
        return Html::tag('div', $this->button, ['class' => 'btn-group', 'role' => 'group']);
    }

}
