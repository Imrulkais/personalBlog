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
        
        
        $http({
                        method: 'get',
                        url: '{{action('SubmitController@getContact')}}'
                    }).then(function (response) {

                        $scope.contactresult = JSON.stringify(response.data);
            //            alert($scope.result);
                        $scope.contactresult = response.data[0].address;
                      console.log($scope.contactresult);
                    })
        
    })
</script>


<div class="full_content" ng-controller="aboutController">
    <div class="container"> 
        <div class="banner darken">
            <h2>HI! I AM IMRUL KAIS</h2><br>
            <h4>Web developer</h4>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="container">

        <div class="row" ng-repeat="results in allresult">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                <h3 class="my_story">MY STORY</h3>
                <p >[[ results.myStory ]]</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                <img src="{{asset('dist/images/mine.jpg')}}" class="img-thumbnail personal_image" alt="Cinque Terre" width="304" height="236">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                <h3 class="my_story">PERSONAL INFORMATION</h3>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>Md. Imrul Kais</td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>[[ results.age ]]</td>
                        </tr>   
                        <tr>
                            <td>Email</td>
                            <td>[[ results.email ]]</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>[[ contactresult ]]</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <?php if (Auth::check()) { ?>
            <a href="{{url('editabout')}}" class="btn btn-default" role="button" style="float: right;margin: 10px 0px;" >EDIT</a>
           <?php } ?>
    </div>
</div>

@stop