<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Page;
use AvtoDev\JsonRpc\Requests\RequestInterface;

class PagesController extends Controller
{
    public function getPage(RequestInterface $request)
    {
        $page_uid = $request->getParameterByPath('page_uid');
        if ($page_uid) {
            $page = Page::where('page_uid', $page_uid)->first(['id', 'created_at']);
            if ($page) {
                $page = $page->toArray();
                $fields = Field::where('page_id', $page['id'])->get(['name', 'value']);
                if ($fields) {
                    $fields = $fields->toArray();
                    return array(
                        'page' => $page,
                        'fields' => $fields
                    );
                }
            }
        }
        return null;
    }

    public function addPage(RequestInterface $request)
    {
        $page_uid = $request->getParameterByPath('page_uid');
        $fields = $request->getParameterByPath('fields');
        if (is_array($fields)) {
            $page = new Page;
            $page->page_uid = $page_uid;
            $page->save();
            $saved_fields = array();
            foreach ($fields as $field) {
                $saved_field = new Field;
                $saved_field->page_id = $page->id;
                $saved_field->name = $field->name;
                $saved_field->value = $field->value;
                $saved_field->save();
                $saved_fields[] = $saved_field;
            }
            return array(
                'page' => $page
            );
        }
        return null;
    }

}
