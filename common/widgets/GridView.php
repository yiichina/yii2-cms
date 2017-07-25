<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets;
use yii\helpers\ArrayHelper;

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
    public $layout = "<div class=\"grid-tool\">
     <div class=\"btn-group\">
                  <button type=\"button\" class=\"btn btn-warning btn-sm btn-flat dropdown-toggle\" data-toggle=\"dropdown\">
                    批量操作 <span class=\"caret\"></span>
                    <span class=\"sr-only\">Toggle Dropdown</span>
                  </button>
                  <ul class=\"dropdown-menu\" role=\"menu\">
                    <li><a href=\"#\">Action</a></li>
                    <li><a href=\"#\">Another action</a></li>
                    <li><a href=\"#\">Something else here</a></li>
                    <li class=\"divider\"></li>
                    <li><a href=\"#\">Separated link</a></li>
                  </ul>
                </div><div class=\"pull-right\"><select class=\"form-control select2\"><option>每页显示20条</option></select><a class=\"btn btn-flat btn-sm btn-success\">新建</a></div>
</div>\n{items}\n{summary}<div class=\"pull-right\">{pager}\n</div>";
	
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
                case '{summary}':
                    return $this->renderSummary();
                case '{items}':
                    return $this->renderItems();
                case '{pager}':
                    return $this->renderPager();
                case '{sorter}':
                    return $this->renderSorter();
                default:
                    return false;
            }
        }
        return $result;
    }

}
