<?php

function getCategory($category,$parent,$editId,$shift,$active)
{
    foreach ($category as $row) {
        if ($row->parent == $parent) {
            if ($row->id == $editId) {
                echo '<option value="'.$row->id.'" disabled>'.$shift.' '.$row->name.'</option>';
            } else {
                if ($row->id == $active) {
                    echo '<option selected value="'.$row->id.'">'.$shift.' '.$row->name.'</option>';
                } else {
                    echo '<option value="'.$row->id.'">'.$shift.' '.$row->name.'</option>';
                }
            }
            getCategory($category,$row->id,$editId,$shift.'---|',$active);
        }
    }
}

function showCategory($category,$parent,$shift)
{
    foreach ($category as $row) {
        if ($row->parent == $parent) {
            echo '<div class="item-menu"><span>'.$shift.' '.$row->name.'</span>
                    <div class="category-fix">
                        <a class="btn-category btn-primary" href="/admin/category/edit/'.$row->id.'"><i class="fa fa-edit"></i></a>
                        <a onclick="return delCategory(name)" name="'.$row->name.'" class="btn-category btn-danger" href="/admin/category/delete/'.$row->id.'"><i class="fas fa-times"></i></i></a>

                    </div>
                </div>';
                showCategory($category,$row->id,$shift.'---|');
        }
    }
}

function checkLevel($list,$parent,$count)
{
    foreach ($list as $cate) {
        if ($cate->id == $parent) {
            $count++;

            if ($cate->parent == 0) {
                return $count;
            }

            return checkLevel($list,$cate->parent,$count);
        }
    }
}

function productStatus($status)
{
    if ($status == 1) {
        return 'In stock';
    } else {
        return 'Out of Stock';
    }
}

function attr_values($array)
{
    $result = [];
    foreach ($array as $value) {
        $attr = $value->attribute->name;
        $result[$attr][] = $value->value;
    }
    return $result;
}

function codeName($name, $id) {
    $prdCode = '';
    $name = iconv('utf-8', 'ascii//TRANSLIT', $name);
    $id = sprintf('%06d', $id);
    $codeName = explode(' ', $name);
    foreach ($codeName as $code) {
        $prdCode .= strtoupper(substr($code,0,1));
    }

    return $prdCode.$id;
}