<?php

namespace backend\widgets;

use yii\bootstrap\ButtonDropdown;
use yii\helpers\Html;
use yiichina\icons\Icon;

use Yii;

class GridView extends \yii\grid\GridView
{
	public $batchItems = false;
	public $sizeItems = [
        ['label' =>'30条', 'url' => ['disable']],
        ['label' => '50条', 'url' => ['enable']],
    ];
	public $button = false;
    public $layout = "<div class=\"grid-tool\">{batch}<div class=\"pull-right\"><div class=\"btn-toolbar\">{size}{button}</div></div></div>\n{items}\n{summary}<div class=\"pull-right\">{pager}\n</div>";
	
	/**
     * Initializes the grid view.
     * This method will initialize required property values and instantiate [[columns]] objects.
     */
    public function init()
    {
		parent::init();
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
        return ButtonDropdown::widget([
            'label' => Icon::show('cog', 'fa') . '批量操作',
            'options' => ['class' => 'btn-sm btn-flat btn-warning'],
            'encodeLabel' => false,
            'dropdown' => [
                'items' => $this->batchItems,
            ],
        ]);
    }

    protected function renderSize()
    {
		$pageSize = $this->dataProvider->pagination->pageSize;
        return ButtonDropdown::widget([
            'label' => Icon::show('list', 'fa') . "每页显示 <b>$pageSize</b> 条",
            'options' => ['class' => 'btn-sm btn-flat btn-primary'],
            'containerOptions' => ['role' => 'group'],
            'encodeLabel' => false,
            'dropdown' => [
                'items' => $this->sizeItems,
            ],
        ]); 
    }

    protected function renderButton()
    {
        return Html::tag('div', $this->button, ['class' => 'btn-group', 'role' => 'group']);
    }

}
