<?php
namespace redleks\tree\widgets;

use yii;

class Tree extends \yii\base\Widget
{
    public $model = null;
    public $updateUrl = 'cards/update';
    public $viewUrl = 'cards/view';
    public $deleteUrl = 'cards/delete';
    public $viewUrlToSearch = false;
    public $viewUrlModelName = 'ProductSearch';
    public $viewUrlModelField = 'category_id';
    public $orderField = false;
    public $parentField = 'parent_id';
    public $idField = 'id';
    public $idCardField = 'id_card';
    public $view = 'index';
    public $currentElementId = 0;
    
    public function init()
    {
        parent::init();

        \redleks\tree\assets\WidgetAsset::register($this->getView());
    }
    
    public function run()
    {
        $model = $this->model;

        if($this->orderField) {
            $list = $model::find()->orderBy($this->orderField)->asArray()->all();
        } else {
            $list = $model::find()->asArray()->all();
        }
        $itemsTree = self::buildArray($list, $this->currentElementId, $this->idCardField, $this->parentField);

       return $this->render($this->view, [
            'categoriesTree' => self::treeBuild($itemsTree),
        ]);
    }

    private function buildArray($items, $currentElementId = 0, $idKeyname = 'id', $parentIdKeyname = 'parent_id', $parentarrayName = 'childs')
    {
        if(empty($items)) return array();
        $return = [];
        foreach($items as $item) {
            if($item[$parentIdKeyname] == $currentElementId) {
                $item[$parentarrayName] = self::buildArray($items, $item[$idKeyname], $idKeyname, $parentIdKeyname, $parentarrayName);
                $return[] = $item;
            }
        }
        return $return;
    }
    
    private function treeBuild($items)
    {
        $return = '';
        foreach($items as $item) {
            $return .= '<li>';
            $return .= $this->render('parts/tree_inlist.php', ['widget' => $this, 'category' => $item]);
            if(!empty($item['childs'])) {
                $return .= '<ul class="child">';
                $return .= $this->treeBuild($item['childs']);
                $return .= '</ul>';
            }
            $return .= '</li>';
        }
        return $return;
    }
}
