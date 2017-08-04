@extends('master')  
@section('content') 
<script>
    GlobalApp.controller('postController', function ($scope, $http) {

        $http({
        method: 'get',
                url: '{{action('SubmitController@getCategory')}}'
    }).then(function (response) {
        $scope.result = JSON.stringify(response.data);
//            alert($scope.result);
        $scope.categoryResult = response.data;
        console.log($scope.categoryResult);
    })
    })
</script>
<div class="full_content" ng-controller="postController">
    <div class="container">
        <!--<form class="form-horizontal" method="get" action="{{url('submitaddportfolio')}}" enctype="multipart/form-data" >-->
        {!! Form::open(array('url'=>'submitpost','method'=>'post','class'=>'form-horizontal')) !!}

        <input type="hidden" name="_token" value="{{ csrf_token()}}">

        <div class="form-group @if($errors->has('Ptitle')) has-error @endif" >
            <label class="control-label col-sm-2" for="title">Post title:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Ptitle" name="Ptitle" placeholder="Enter post title">
                @if($errors->has('Ptitle'))<span style="color:red">{{$errors->first('Ptitle')}}</span><br>@endif
            </div>
        </div>
        <div class="form-group @if($errors->has('content')) has-error @endif" >
            <label class="control-label col-sm-2" for="details">Post content:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="15" id="pdetails" name="content" ></textarea>
                @if($errors->has('content'))<span style="color:red">{{$errors -> first('content')}}</span><br>@endif
            </div>
        </div>
<!--        <div class="form-group @if($errors->has('category_id')) has-error @endif" >
            <label class="control-label col-sm-2" for="title">Category:</label>
            <div class="col-sm-10">
                <select  class="form-control" name="category_id">
                    <option ng-repeat="x in categoryResult" value="[[x.id]]">[[ x.category ]]</option>
                </select>
                @if($errors->has('category_id'))<span style="color:red">{{$errors -> first('category_id')}}</span><br>@endif
            </div>
        </div>-->
        <div class="form-group" >
            <label class="control-label col-sm-2" for="title">Category:</label>
            <div class="col-sm-10">
                    <label class="checkbox-inline" ng-repeat="x in categoryResult">
                        <input type="checkbox" name="[[ x.category ]]" value="[[x.id]]">[[ x.category ]]
                    </label>
            </div>
        </div>
        
        <div class="form-group" >
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Add</button>
            </div>
        </div>
        {!! Form::close() !!}
        <!--</form>-->
    </div>
</div>
@stop 
