<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/13
 * Time: 17:08
 */

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::macro('buildTree', function($parent_id = 'parent_id', $children = 'children', $list = null)
        {
            if (!$list) {
                $list = $this;
            }
            $tree = $this->filter(function ($item) use (&$parent_id) {
                return !$item->$parent_id;
            });
            $list = $list->filter(function ($item) use (&$parent_id) {
                return $item->$parent_id;
            });
            $builder = function (&$childs,$level=1) use (&$builder, &$list, &$children, &$parent_id) {
                if (!$childs) {
                    return;
                }
                foreach ($childs as $child) {
                    $id = $child->id;
                    $child->level = $level;
                    $child->$children = $list->filter(function ($item) use ($id, $parent_id) {
                        return $item->$parent_id == $id;
                    });
                    $list = $list->filter(function ($item) use ($id, $parent_id) {
                        return $item->$parent_id != $id;
                    });
                    $builder($child->$children,$level + 1);
                }
            };
            $builder($tree);

            return $tree;
        });

        Collection::macro('mergeTree', function($children = 'children', $level=0)
        {
            $tree = $this;
            $list = collect([]);
            $builder = function (&$childs, $level) use (&$builder, &$list, &$children) {
                if (!$childs || !$childs->count()) {
                    return;
                }
                foreach ($childs as $child) {
                    $child->level = $level;
                    $list->push($child);
                    if (isset($child->$children) && count($child->$children)) {
                        $builder($child->$children, $level + 1);
                    }
                    unset($child->$children);
                }
            };
            $builder($tree, 1);

            return $list;
        });
    }
}