<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    protected $fillable = [
        'option_name',
        'option_value',
        'option_type',
        'option_label'
    ];

    public function getAllOption()
    {
        return self::get();
    }

    public function updateOptionByOptionName($option_name, $option_value)
    {
        $option = $this->where('option_name', $option_name)->first()->update(['option_value', $option_value]);
        return $option;
    }

    public function addNewOption($option_name = '', $option_value = '', $option_type = '', $option_label = '')
    {
        return $this->create(['option_name' => $option_name, 'option_value' => $option_value, 'option_type' => $option_type, 'option_label' => $option_label]);
    }

    public function getOption($option_name)
    {
        return $this->where('option_name', $option_name)->first();
    }

    public function getField($option_name)
    {
        if ($option = $this->where('option_name', $option_name)->first()) {
            if (is_array(json_decode($option->option_value))) {
                $data = json_decode($option->option_value);
                if (isset($data[0]->column)) {
                    $arr = array();
                    $arr2 = array();
                    if (!empty($data)) {
                        $index = 0;
                        $key = '';
                        foreach ($data as $value) {
                            foreach ($value->column as $item) {
                                $arr2[$item->repeater_slug] = $item->repeater_value;
                            }
                            $arr[$index][$value->name] = $arr2;
                            $index++;
                            $dex = 0;
                            $key = $value->name;
                        }
                        return $arr;
                    } else {
                        return array();
                    }
                } else {
                    return $data;
                }
            } else {
                return $option->option_value;
            }
        } else {
            return array();
        }
    }
}
