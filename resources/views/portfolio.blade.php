@extends('master')  
@section('content')   



<script>
    GlobalApp.controller('portfolioController', function ($scope, $http) {

    $http({
    method: 'get',
            url: '{{action('SubmitController@getPortfolio')}}'
    }).then(function (response) {

    $scope.result = JSON.stringify(response.data);
//            alert($scope.result);
            $scope.allresult = response.data;
//            console.log($scope.allresult[0]);
    })
            $scope.getSingleData = function (id) {
            $http({
            method: 'get',
                    url: '{{action('SubmitController@getSinglePortfolio')}}',
                    params:{portfolioId:id}
            }).then(function (response) {

            $scope.result = JSON.stringify(response.data);
                    $scope.allSingleResult = response.data;
//                    console.log($scope.allSingleResult);
            })
            }

    })
</script>

<div class="full_area" ng-controller="portfolioController">
    <div class="full_content">
        <div class="container"> 
            <div class="banner darken">
                <h2>HI! I AM IMRUL KAIS</h2><br>
                <h4>Web developer</h4>
            </div>
        </div>
        <div class="container" >
            <div class="full_portfolio" >
                <div class="row" >
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" ng-repeat="results in allresult">
                        <div class="single_caption" ng-click="getSingleData(results.id)">
                            <a class="thumbnail" href="#" data-toggle="modal" data-target="#myModal">
                                <div class="portfolio-title" ><h5 id="something">VIEW DETAILS</h5> </div>
                                <img ng-src="{{asset('')}}[[ results.image ]]" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="thumbnail_button">
                            <a href="[[results.link]]" target="_blank" class="btn btn-default" role="button" >GO TO THE LINK</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (Auth::check()) { ?>
                <a href="{{url('addportfolio')}}" class="btn btn-default" role="button" style="float: right;margin: 10px 0px;" >ADD NEW</a>
            <?php } ?>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog"  ng-show="allSingleResult">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">[[allSingleResult.title]]</h4>
                </div>
                <div class="modal-body">
                    <img ng-src="{{asset('')}}[[ allSingleResult.image ]]" class="img-responsive"><br>
                    <p>[[ allSingleResult.details ]]</p>
                    <a href="[[ allSingleResult.link ]]" target="_blank">click here to see the site</a>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php if (Auth::check()) { ?>
                    <a href="{{URL('editsingleportfolio/')}}/[[ allSingleResult.id ]]" class="btn btn-default" role="button" >EDIT</a>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>

@stop