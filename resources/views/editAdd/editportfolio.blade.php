@extends('master')  
@section('content')   

<script>
    GlobalApp.controller('editPortfolioController', function ($scope, $http) {
        $scope.id = {{$id}};
        $http({
            method: 'get',
                    url: '{{action('SubmitController@getSinglePortfolio')}}',
                    params:{portfolioId:$scope.id}
            }).then(function (response) {

            $scope.result = JSON.stringify(response.data);
                    $scope.allSingleResult = response.data;
//                    console.log($scope.allSingleResult);
            })
    })
</script>

<div class="full_content" ng-controller="editPortfolioController">
    <div class="container">
        <!--<form class="form-horizontal" method="get" action="{{url('submitaddportfolio')}}" enctype="multipart/form-data" >-->
            {!! Form::open(array('url'=>'doeditportfolio/'.$id,'method'=>'post','files'=>'true','class'=>'form-horizontal')) !!}

            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="form-group @if($errors->has('filename')) has-error @endif" >
                <label class="control-label col-sm-2" for="file">Image:</label>
                <div class="col-sm-10">
                    <input type='file' name="filename"  onchange="readURL(this);" />
                    <img id="blah" src="#" alt="your image" style="margin-top: 15px;" />
                    @if($errors->has('filename'))<span style="color:red">{{$errors->first('filename')}}</span><br>@endif

                </div>
            </div>
            <div class="form-group @if($errors->has('title')) has-error @endif" >
                <label class="control-label col-sm-2" for="title">Project title:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter project title" value="[[allSingleResult.title]]">
                    @if($errors->has('title'))<span style="color:red">{{$errors->first('title')}}</span><br>@endif
                </div>
            </div>
            <div class="form-group @if($errors->has('pdetails')) has-error @endif" >
                <label class="control-label col-sm-2" for="details">Project details:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="15" id="pdetails" name="pdetails" >[[allSingleResult.details]]</textarea>
                    @if($errors->has('pdetails'))<span style="color:red">{{$errors->first('pdetails')}}</span><br>@endif
                </div>
            </div>
            <div class="form-group @if($errors->has('link')) has-error @endif" >
                <label class="control-label col-sm-2" for="link">Link:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="link" name="link" value="[[allSingleResult.link]]" placeholder="Enter project link">
                    @if($errors->has('link'))<span style="color:red">{{$errors->first('link')}}</span><br>@endif
                </div>
            </div>
            <div class="form-group" >
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            </div>
            {!! Form::close() !!}
        <!--</form>-->
    </div>
</div>


<script type="text/javascript">

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                        .attr('src', e.target.result)
                        .width(350)
                        .height(250);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@stop