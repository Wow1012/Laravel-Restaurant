@extends('layouts.app')

@section('content')

<link href="assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>@lang('common.categories') </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('')}}">@lang('common.home')</a>
                        </li>
                     
                        <li class="active">
                            <strong>@lang('common.categories')</strong>
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
                        <h5>@lang('common.categories')  </h5>
                        <div class="ibox-tools">
						<a href="{{ url('categories/create') }}" class="btn btn-primary btn-xs">@lang('common.add_new')</a>
						
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
							
                          
                           
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" >
					
					 <thead>
                        <tr>
                             <th>#</th>
                            <th>Image</th>
                            <th>@lang('common.name')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($categories as $key => $category)
                        <tr class="gradeX">
                             <td>{{ $categories->firstItem() + $key }}</td>
                             <td><img width="70" id="image_source"  src="<?php echo url("uploads/category/thumb/" . $category->id . ".jpg?rand=".rand(0, 100)); ?>"></td>
                            <td>{{ $category->name }}</td>
                           
                            <td>
                                <form id="delete-customer" action="{{ url('categories/' . $category->id) }}" method="POST" class="form-inline">
                                    <input type="hidden" name="_method" value="Cancella">
                                    {{ csrf_field() }}
                                    <input type="submit" value="Cancella" class="btn btn-danger btn-xs pull-right btn-delete">
                                </form>
                                <a href="{{ url('categories/' . $category->id . '/edit') }}" class="btn btn-primary btn-xs pull-right">Modifica</a>
                            </td>
                        </tr>
                    @empty
                       <tr> 
						  <td colspan="5">@lang('common.no_record_found') </td></tr>
                    @endforelse
						<tr> 
						  <td colspan="5">
						{!! $categories->render() !!}
						</td>
								</tr>
                    </tbody>
            
                    
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
           
        </div>
       
      
    

@endsection
