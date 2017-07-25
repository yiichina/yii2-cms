<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\widgets;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\Html;
use yiichina\icons\Icon;

use Yii;

class GridView extends \yii\grid\GridView
{
    /**
     * @var string the layout that determines how different sections of the list view should be organized.
     * The following tokens will be replaced with the corresponding section contents:
     *
     * - `{summary}`: the summary section. See [[renderSummary()]].
     * - `{errors}`: the filter model error summary. See [[renderErrors()]].
     * - `{items}`: the list items. See [[renderItems()]].
     * - `{sorter}`: the sorter. See [[renderSorter()]].
     * - `{pager}`: the pager. See [[renderPager()]].
     */
    public $layout = "<div class=\"grid-tool\">{batch}<div class=\"pull-right\"><div class=\"btn-toolbar\">{perpage}{create}</div></div></div>\n{items}\n{summary}<div class=\"pull-right\">{pager}\n</div>";
	
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
                case '{perpage}':
                    return $this->renderPerPage();
                case '{create}':
                    return $this->renderCreate();
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
                'items' => [
                    ['label' => 'DropdownA', 'url' => '/'],
                    ['label' => 'DropdownB', 'url' => '#'],
                ],
            ],
        ]);
    }

    protected function renderPerPage()
    {
        return ButtonDropdown::widget([
            'label' => Icon::show('list', 'fa') . '每页显示 <b>20</b> 条',
            'options' => ['class' => 'btn-sm btn-flat btn-primary'],
            'containerOptions' => ['role' => 'group'],
            'encodeLabel' => false,
            'dropdown' => [
                'items' => [
                    ['label' => 'DropdownA', 'url' => '/'],
                    ['label' => 'DropdownB', 'url' => '#'],
                ],
            ],
        ]); 
    }

    protected function renderCreate()
    {
        return Html::tag('div', Html::a(Icon::show('plus', 'fa') . '新建用户', ['create'], ['class' => 'btn btn-sm btn-flat btn-success']), ['class' => 'btn-group', 'role' => 'group']);
    }

}
