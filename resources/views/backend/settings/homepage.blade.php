@extends('layouts.app')

@section('content')
<link href="{{url('assets/css/plugins/chosen/chosen.css')}}" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>HomePage Settings</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('')}}">@lang('common.home')</a>
                        </li>
                        
                        <li class="active">
                            <strong>HomePage Settings</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
			
			<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>HomePage Settings</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                
                                
                            </div>
                        </div>
                        <div class="ibox-content">
						
			

<form action="{{ url('settings/homepage') }}" class="form-horizontal" method="POST" enctype='multipart/form-data'>
                        {{ csrf_field() }}
 @forelse($homepage as $home)
 
 @if($home->type == "text") 

 <div class="form-group">
 <label class="col-sm-2 control-label">{{ $home->label }}</label>
                                    <div class="col-sm-10">  <input type="text" class="form-control" id="{{ $home->key }}" name="{{ $home->key }}" value="{{ old($home->key, $home->value) }}"></div>
                                </div>
				@endif
				
				@if($home->type == "textarea") 

 <div class="form-group">
						<label class="col-sm-2 control-label">{{ $home->label }}</label>
                                    <div class="col-sm-10"> 
									<textarea class="form-control" id="{{ $home->key }}" name="{{ $home->key }}">{{$home->value }}</textarea>
									</div>
                                </div>
				@endif
				
                                <div class="hr-line-dashed"></div>
								
           
          
            @empty
            @endforelse
				<?php $cat_array = array();
                    $cats = homepage_by_key('category');
    if(!empty($cats)) {
        foreach(explode(",", $cats) as $c) { 
            $cat_array[] = $c;
        }
        $category = explode(",", $cats);
    }     
                ?>
                                        
                <div class="form-group">
                        <label class="col-sm-2 control-label">Home Categories</label>
                                    <div class="col-sm-10"> 
                                     <select data-placeholder="Choose a Category..." class="chosen-select" name="category[]" multiple style="width:350px;" tabindex="4">
                                        @foreach($categories as $category)
                                        <option <?php if(in_array($category->id, $cat_array)) { echo "selected"; 
                                       }?> value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                </div>
                 <div class="hr-line-dashed"></div>
                                
                            <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        
                                         <a class="btn btn-white" href="{{ url('settings/general') }}">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </div>
                                </div>
         </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
             <script src="{{url('assets/js/plugins/chosen/chosen.jquery.js')}}"></script>
            <script> 
             var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
            </script>
@endsection
