<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Component;

class ComponentController extends Controller
{
    private $vue;
    public function __construct()
    {
        $this->vue();
    }
    public function index()
    {
        $component = Component::paginate(10);
        return view('component.index', compact(
            'component'
        ));
    }

    public function create()
    {
        return view('component.create');
    }

    public function store(Request $request)
    {
        $component = new Component();
        $component->name = $request->name;
        $component->enname = $request->enname;
        $component->class = $request->class;
        $component->version = $request->version;
        $component->dependent = $request->dependent;
        $component->parameter = $request->parameter;
        $component->datasource = $request->datasource;
        $component->introduction = $request->introduction;
        $component->example = htmlspecialchars($_POST['example']);
        $component->template = htmlspecialchars($_POST['template']);
        $component->javascript = htmlspecialchars($_POST['javascript']);
        $component->style = htmlspecialchars($_POST['style']);
        if($component->save())
        {
            return redirect('/component');
        }else{
            echo '添加失败';
        }
    }

    public function edit($id)
    {
        $component = Component::find($id);
        $vue = $this->vue;
        return view('component.edit', compact(
            'component',
            'id',
            'vue'
        ));
    }

    public function update(Request $request, $id)
    {
        $component = Component::find($id);
        $component->name = $request->name;
        $component->enname = $request->enname;
        $component->class = $request->class;
        $component->version = $request->version;
        $component->dependent = $request->dependent;
        $component->parameter = $request->parameter;
        $component->datasource = $request->datasource;
        $component->introduction = $request->introduction;
        $component->example = htmlspecialchars($_POST['example']);
        $component->template = htmlspecialchars($_POST['template']);
        $component->javascript = htmlspecialchars($_POST['javascript']);
        $component->style = htmlspecialchars($_POST['style']);
        if($component->save())
        {
            return redirect('/component');
        }else{
            echo '更新失败';
        }
    }

    public function vue()
    {
        // $vue = \file_get_contents(public_path('vue.min.js'));
        $vue = asset('js/vue/vue.js');

        return $this->vue=$vue;
    }

    /**
        根据id获取组件信息
    */
    public function getById($id)
    {
        $component = Component::find($id);

        $result = [];
        $result['data']['template'] = \htmlspecialchars_decode($component->template);
        $result['data']['javascript'] = \htmlspecialchars_decode($component->javascript);
        $result['data']['style'] = \htmlspecialchars_decode($component->style);
        $result['error'] = 0;
        echo \json_encode($result);
    }
}