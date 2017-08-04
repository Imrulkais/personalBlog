@extends('master')  
@section('content') 

<script>
                GlobalApp.controller('contactController', function ($scope, $http) {

                    $http({
                        method: 'get',
                        url: '{{action('SubmitController@getContact')}}'
                    }).then(function (response) {

                        $scope.result = JSON.stringify(response.data);
            //            alert($scope.result);
                        $scope.allresult = response.data;
                      console.log($scope.allresult[0]);
                    })
                })
            </script>

<div class="full_content" ng-controller="contactController">
    <div class="container">
        <form class="form-horizontal" method="post" action="{{url('submitcontact')}}" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="simple" ng-repeat="results in allresult">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="address">Address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="[[ results.address ]]">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Facebook address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="age" name="facebook" placeholder="Enter age" value="[[ results.facebook ]]" >
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Twitter address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="story" name="twitter" placeholder="Enter twitter address" value="[[ results.twitter ]]">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Googleplus address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="story" name="googleplus" placeholder="Enter googleplus address" value="[[ results.googlePlus ]]">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">LinkedIn address:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="story" name="linkedin" placeholder="Enter linkedIn address" value="[[ results.linkedIn ]]">
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

