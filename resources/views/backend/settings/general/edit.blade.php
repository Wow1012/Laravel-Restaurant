@extends('layouts.app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>General Settings</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('')}}">@lang('common.home')</a>
                        </li>
                        
                        <li class="active">
                            <strong>General Settings</strong>
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
                            <h5>General Settings</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                
                                
                            </div>
                        </div>
                        <div class="ibox-content">
						
			

<form action="{{ url('settings/general') }}" class="form-horizontal" method="POST" enctype='multipart/form-data'>
                        {{ csrf_field() }}
 @forelse($settings as $setting)

 @if($setting->key != "stripe") 
 <div class="form-group">
 <label class="col-sm-2 control-label">{{ $setting->label }}</label>
                                    <div class="col-sm-10">  <input type="text" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
								
					
           
          @endif
		  
		  @if($setting->key == "stripe") 
			 <?php  $stripe_label = $setting->label;  ?>
			 <?php  $stripe_value = $setting->value;  ?>
		  @endif
		  
		   @if($setting->key == "frontend") 
			 <?php  $frontend_label = $setting->label;  ?>
			 <?php  $frontend_value = $setting->value;  ?>
		  @endif
            @empty
            @endforelse
				
			 <div class="form-group">
							 <label class="col-sm-2 control-label">{{ $stripe_label }}</label>
							 <div class="form-group col-sm-10">
									<select name="stripe" class="form-control"> 
										<option <?php if($stripe_value == "yes") echo "selected";  ?> value="yes"> Yes </option>
										<option <?php if($stripe_value == "no") echo "selected";  ?>  value="no"> No </option>
									</select>
                                    
                                </div>
                                </div>
                                <div class="hr-line-dashed"></div>
								
								<div class="form-group">
							 <label class="col-sm-2 control-label">{{ $frontend_label }}</label>
							 <div class="form-group col-sm-10">
									<select name="frontend" class="form-control"> 
										<option <?php if($frontend_value == "yes") echo "selected";  ?> value="yes"> Yes </option>
										<option <?php if($frontend_value == "no") echo "selected";  ?>  value="no"> No </option>
									</select>
                                    
                                </div>
                                </div>
                                <div class="hr-line-dashed"></div>
								
								<div class="form-group">
							 <label class="col-sm-2 control-label">Logo</label>
								<div class="form-group col-sm-10">
									<input type="file" name="logo" class="form-control"/> 
									<img src="{{url('uploads/logo.jpg?r=' . rand(0,999))}}" width="100px">
                                									
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
@endsection