<?php

function getCategory($category, $parent, $shift, $active)
{
    foreach ($category as $row) {
        if ($row->parent == $parent) {
            if ($row->id == $active) {
                echo '<option selected value="'.$row->id.'">'.$shift.' '.$row->name.'</option>';
            } else {
                echo '<option value="'.$row->id.'">'.$shift.' '.$row->name.'</option>';
            }
            getCategory($category,$row->id,$shift.'---|',$active);
        }
    }
}

function showCategory($category, $parent, $shift)
{
    foreach ($category as $row) {
        if ($row->parent == $parent) {
            echo '<div class="item-menu"><span>'.$shift.' '.$row->name.'</span>
                    <div class="category-fix">
                        <a class="btn-category btn-primary" href="/admin/category/edit/'.$row->id.'"><i class="fa fa-edit"></i></a>
                        <a onclick="return delCategory(name)" name="'.$row->name.'" class="btn-category btn-danger" href="/admin/category/delete/'.$row->id.'"><i class="fas fa-times"></i></i></a>

                    </div>
                </div>';
                showCategory($category, $row->id, $shift.'---|');
        }
    }
}

function checkLevel($list, $parent, $count)
{
    foreach ($list as $cate) {
        if ($cate->id == $parent) {
            $count++;

            if ($cate->parent == 0) {
                return $count;
            }

            return checkLevel($list, $cate->parent, $count);
        }
    }
}