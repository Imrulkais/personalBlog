@extends('master')  
@section('content') 

<script>
    GlobalApp.controller('aboutController', function ($scope, $http) {
        
        $http({
            method: 'get',
            url: '{{action('SubmitController@getAbout')}}'
        }).then(function (response) {
            
            $scope.result = JSON.stringify(response.data);
//            alert($scope.result);
            $scope.allresult = response.data;
//          console.log($scope.allresult[0]);
        })
    })
</script>

<div class="full_content" ng-controller="aboutController">
    <div class="container">
        <form class="form-horizontal" method="post" action="{{url('submitabout')}}" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="simple" ng-repeat="results in allresult">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="story">My story:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="15" id="story" name="mystory" > [[ results.myStory ]] </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Age:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="age" name="age" placeholder="Enter age" value="[[ results.age ]]" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="[[ results.email ]]">
                    </div>
                </div>
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

