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
    $name = str_replace(unicode(), noSpecialCharacters(), $name);
    $id = sprintf('%06d', $id);
    $codeName = explode(' ', $name);
    foreach ($codeName as $code) {
        $prdCode .= strtoupper(substr($code,0,1));
    }

    return $prdCode.$id;
}

function convertCharacters($name) {
    $name = str_replace(unicode(), noSpecialCharacters(), $name);
    return $name;
}

function unicode() {
    return [
        "à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
        "è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
        "ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
        "Đ"
    ];
}

function noSpecialCharacters() {
    return [
        "a","a","a","a","a","a","a","a","a","a","a" ,"a","a","a","a","a","a",
        "e","e","e","e","e","e","e","e","e","e","e",
        "i","i","i","i","i",
        "o","o","o","o","o","o","o","o","o","o","o","o" ,"o","o","o","o","o",
        "u","u","u","u","u","u","u","u","u","u","u",
        "y","y","y","y","y",
        "d",
        "A","A","A","A","A","A","A","A","A","A","A","A" ,"A","A","A","A","A",
        "E","E","E","E","E","E","E","E","E","E","E",
        "I","I","I","I","I",
        "O","O","O","O","O","O","O","O","O","O","O","O" ,"O","O","O","O","O",
        "U","U","U","U","U","U","U","U","U","U","U",
        "Y","Y","Y","Y","Y",
        "D"
    ];
}

function getCombinations($array) {
    $result = [[]];
    foreach ($array as $property => $property_values) {
        $tmp = [];
        foreach ($result as $item) {
            foreach ($property_values as $value) {
                $tmp[] = array_merge($item, [$property => $value]);
            }
        }
        $result = $tmp;
    }
    return $result;
}

function checkValue($products, $valId) {
    foreach ($products->values as $val) {
        if ($val->id == $valId) {
            return true;
        }
    }
    return false;
}

function valueAttr($values) {
    $array = [];
    foreach ($values as $value) {
        $attr = $value->attribute->name;
        $array[$attr][] = $value->value;
    }
    
    return $array;
}