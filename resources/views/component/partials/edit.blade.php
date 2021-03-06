<ul class="nav ul-edit nav-tabs responsive">
    <li class="active"><a href="#tab-form-actions" data-toggle="tab">参数设置</a>
    </li>
    <li><a href="#tab-two-columns" data-toggle="tab">代码</a>
    </li>
    <li><a href="#tab-result" data-toggle="tab" onclick="run()">预览</a>
    </li>
</ul>
<form action="{{ route('component.update' , ['id' => $id]) }}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="PUT">
{!! csrf_field() !!}
<div style="background: transparent; border: 0; box-shadow: none !important" class="tab-content pan mtl mbn responsive">
    <div id="tab-form-actions" class="tab-pane fade active in">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-red">
                    <div class="panel-body pan">
                        <div class="form-body pal">
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">名称 <span class='require'>*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="">
                                        <input id="name" type="text" placeholder="组件名称" class="form-control" name="name" value="{{$component->name}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">英文名称 <span class='require'>*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="">
                                        <input id="enname" type="text" placeholder="英文名称" class="form-control" name="enname" value="{{$component->enname}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">分类</label>
                                <div class="col-md-6">
                                    <select data-style="btn-white" data-live-search="true" class="selectpicker form-control" name="class">
                                        <option value="" <?php if($component->class == "") echo 'selected';?>>----请选择----</option>
                                        <option value="1" <?php if($component->class == "1") echo 'selected';?>>基础组件</option>
                                        <option value="2" <?php if($component->class == "2") echo 'selected';?>>业务组件</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">版本 <span class='require'>*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="">
                                        <input id="version" type="text" placeholder="版本" class="form-control" name="version" value="{{$component->version}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">依赖组件</label>
                                <div class="col-md-6">
                                    <select data-style="btn-white" data-live-search="true" class="selectpicker form-control" name="dependent">
                                        <option value="">----请选择----</option>
                                        <option value="">组件a</option>
                                        <option value="">组件b</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">参数 <span class='require'>*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="">
                                        <input id="parameter" type="text" placeholder="参数" class="form-control" name="parameter" value="{{$component->parameter}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">数据源</label>
                                <div class="col-md-6">
                                    <select data-style="btn-white" data-live-search="true" class="selectpicker form-control" name="datasource">
                                        <option value="" <?php if($component->datasource == "") echo 'selected';?>>----请选择----</option>
                                        <option value="1" <?php if($component->datasource == "1") echo 'selected';?>>接口</option>
                                        <option value="2" <?php if($component->datasource == "2") echo 'selected';?>>表单</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputContent" class="col-md-3 control-label">功能介绍</label>
                                <div class="col-md-6">
                                    <textarea id="inputContent" rows="3" class="form-control" name="introduction">{{$component->introduction}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputContent" class="col-md-3 control-label">调用示例</label>
                                <div class="col-md-6">
                                    <textarea id="inputContent" rows="3" class="form-control" name="example">{{$component->example}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tab-two-columns" class="tab-pane fade">
    <div class="row">
            <div class="col-lg-12">
                    <ul class="nav ul-edit nav-tabs responsive">
                        <li class="active"><a href="#template_editor" data-toggle="tab">template</a>
                        </li>
                        <li><a href="#javascript_editor" data-toggle="tab">javascript</a>
                        </li>
                        <li><a href="#style_editor" data-toggle="tab">style</a>
                        </li>
                    </ul>

                        <div style="background: transparent; border: 0; box-shadow: none !important" class="tab-content pan mtl mbn responsive">
                            <pre id="template_editor" style="height:500px" class="tab-pane fade active in"></pre>
                            <pre id="javascript_editor" style="height:500px" class="tab-pane fade"></pre>
                            <pre id="style_editor" style="height:500px" class="tab-pane fade"></pre>
                            <!-- load ace -->
                            <script src="{{asset('ace/build/src/ace.js')}}"></script>
                            <!-- load ace language tools -->
                            <script src="{{asset('ace/build/src/ext-language_tools.js')}}"></script>
                            <script>
                                // trigger extension
                                ace.require("ace/ext/language_tools");
                                var template_editor = ace.edit("template_editor");
                                template_editor.session.setMode("ace/mode/html");
                                template_editor.setTheme("ace/theme/tomorrow");
                                // enable autocompletion and snippets
                                template_editor.setOptions({
                                    enableBasicAutocompletion: true,
                                    enableSnippets: true,
                                    enableLiveAutocompletion: true
                                });

                                var javascript_editor = ace.edit("javascript_editor");
                                javascript_editor.session.setMode("ace/mode/html");
                                javascript_editor.setTheme("ace/theme/tomorrow");
                                // enable autocompletion and snippets
                                javascript_editor.setOptions({
                                    enableBasicAutocompletion: true,
                                    enableSnippets: true,
                                    enableLiveAutocompletion: true
                                });

                                var style_editor = ace.edit("style_editor");
                                style_editor.session.setMode("ace/mode/html");
                                style_editor.setTheme("ace/theme/tomorrow");
                                // enable autocompletion and snippets
                                style_editor.setOptions({
                                    enableBasicAutocompletion: true,
                                    enableSnippets: true,
                                    enableLiveAutocompletion: true
                                });
                            </script>
                        </div>
            </div>
        </div>
    </div>
    <div id="tab-result" class="tab-pane fade">
        @include('component.partials.iframe')
    </div>
</div>
<div class="form-actions">
    <div class="col-md-offset-3 col-md-9">
        <input type="hidden" id="template" name="template" value="<?php echo $component->template?>">
        <input type="hidden" id="javascript" name="javascript" value="<?php echo $component->javascript?>">
        <input type="hidden" id="style" name="style" value="<?php echo $component->style?>">
        <button type="submit" class="btn btn-primary" onclick="formSubmit()">Send</button>&nbsp;
        <button type="button" class="btn btn-green">Cancel</button>
    </div>
</div>
</form>
<script>
    template_editor.setValue($("#template").val());
    javascript_editor.setValue($("#javascript").val());
    style_editor.setValue($("#style").val());
</script>
<script src="{{asset('js/run.js')}}"></script>