@extends('master')  
@section('content')  

<script>
    GlobalApp.controller('blogController', function ($scope,$filter, $http) {

            $http({
            method: 'get',
                    url: '{{action('SubmitController@getBlogPost')}}'
            }).then(function (response) {
            $scope.result = JSON.stringify(response.data);
        //            alert($scope.result);
                    $scope.allPostResult = response.data;
                    //console.log($scope.allPostResult);
                    $scope.pagination($scope.allPostResult);
            })

            $scope.pagination = function($allData){

                if($scope.singlePostResult)
                {
                    $scope.singlePostResult = null;
                }
                else if($scope.allCategoryResult){
                    $scope.currentPage = 0;
//                    $filter('startFrom')($allData,$scope.currentPage*$scope.pageSize);
                }
                else
                    $scope.currentPage = 0;

                    $scope.allData = $allData;
                    $scope.pageSize = 4;
                    $scope.numberOfPages = Math.ceil($allData.length/$scope.pageSize);
                    $scope.numberOfPagesInArray = new Array($scope.numberOfPages);
            }

            $http({
            method: 'get',
                    url: '{{action('SubmitController@getCategory')}}'
            }).then(function (response) {
            $scope.result = JSON.stringify(response.data);
        //            alert($scope.result);
                    $scope.categoryResult = response.data;
                   // console.log($scope.categoryResult);
            })

            $http({
                method: 'get',
                url: '{{action('SubmitController@getRecentPost')}}'
            }).then(function (response) {
                $scope.result = JSON.stringify(response.data);
                //            alert($scope.result);
                $scope.recentPostResult = response.data;
                //console.log($scope.result);
            })

            $scope.getSearchData = function (value) {
            $http({
            method: 'get',
                    url: '{{action('SubmitController@getSearchData')}}',
                    params: {searchValue:value}
            }).then(function (response) {

            $scope.result = JSON.stringify(response.data);
                    $scope.allSearchResult = response.data;
                    $scope.pagination($scope.allSearchResult);
                    $scope.allPostResult = "";
                    $scope.allCategoryResult= "";
                    //console.log($scope.allSearchResult);
                    $scope.noResult = "";
                if(response.data == ""){
                    $scope.noResult = 'yes';
                    $scope.allPostResult = "";
                    $scope.allSearchResult = "";
                    $scope.allCategoryResult= "";
                }
            })
            }
        $scope.getCategory = function (value) {
            $scope.currentPage = 0;
            $http({
                method: 'get',
                url: '{{action('SubmitController@getCategoryData')}}',
                params: {searchValue:value}
            }).then(function (response) {
                $scope.result = JSON.stringify(response.data);
                $scope.allCategoryResult = response.data;
                $scope.pagination($scope.allCategoryResult);
                $scope.allPostResult = "";
                $scope.allSearchResult = "";
                $scope.noResult = "";
                if(response.data == ""){
                    $scope.noResult = 'yes';
                    $scope.allPostResult = "";
                    $scope.allSearchResult = "";
                    $scope.allCategoryResult= "";
                }
                //console.log($scope.allCategoryResult);
            })
        }

        $scope.getRelatedPost = function (value) {
            $http({
                method: 'get',
                url: '{{action('SubmitController@getRelatedPost')}}',
                params: {searchValue:value}
            }).then(function (response) {
                $scope.result = JSON.stringify(response.data);
                $scope.allRelatedPost = response.data;
            })
        }

        $scope.getSinglePost = function (id,currentPage) {

            $scope.currentPage = currentPage;
            $http({
                method: 'get',
                url: '{{action('SubmitController@getSinglePost')}}',
                params: {searchId:id}
            }).then(function (response) {
                $scope.result = JSON.stringify(response.data);
                $scope.singlePostResult = response.data;


            })
        }
            
    });
    GlobalApp.filter('startFrom', function() {
        return function(input, start) {

            //alert(JSON.stringify(input));
            start = +start; //parse to int
//            alert(start);
            return input.slice(start);
        }
    });
    GlobalApp.filter("timeOnly", function(){
        return function(input){
            return input.split(' ')[1]; // you can filter your datetime object here as required.
        };
    });
    GlobalApp.filter("dateOnly", function(){
        return function(input){
            return input.split(' ')[0]; // you can filter your datetime object here as required.
        };
    });
</script>

<div class="full_content" ng-controller="blogController">
    <div class="container"> 
        <div class="banner darken">
            <h2>HI! I AM IMRUL KAIS</h2><br>
            <h4>Web developer</h4>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" >
                <div id="tfheader">
                    <form id="tfnewsearch" method="get" action="#">
                        <input type="text" placeholder="Search by title" class="tftextinput" name="q" ng-model="searchData" ng-change="getSearchData(searchData)" size="21" maxlength="120"><input type="submit" disabled value="search" class="tfbutton">
                    </form> 
                    <div class="tfclear"></div>
                </div>
                {{--<div ng-if="allPostResult" ng-repeat="allResult in allPostResult">--}}
                    {{--<a href="#"><h3>[[ allResult.title ]]</h3></a>--}}
                    {{--<div style="margin-bottom: 40px;"><span class="glyphicon glyphicon-user blog-icon"></span><div class="blog-icon-description">Admin</div>--}}
                        {{--<span class="glyphicon glyphicon-time blog-icon"></span><div class="blog-icon-description">[[ allResult.created_at]]</div>--}}
                        {{--<span class="glyphicon glyphicon-calendar blog-icon"></span><div class="blog-icon-description">Calender</div>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}

                    {{--<p>[[ allResult.content | limitTo: 250 ]] ... </p>--}}
                    {{--<a href="#"><p>See more. .</p></a>--}}
                {{--</div>--}}
                {{--<div ng-if="allSearchResult" ng-repeat="allSearch in allSearchResult">--}}
                    {{--<a href="#"><h3>[[ allSearch.title ]]</h3></a>--}}
                    {{--<div style="margin-bottom: 40px;"><span class="glyphicon glyphicon-user blog-icon"></span><div class="blog-icon-description">Admin</div>--}}
                        {{--<span class="glyphicon glyphicon-time blog-icon"></span><div class="blog-icon-description">Time</div>--}}
                        {{--<span class="glyphicon glyphicon-calendar blog-icon"></span><div class="blog-icon-description">Calender</div>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}

                    {{--<p>[[ allSearch.content | limitTo: 250 ]] ... </p>--}}
                    {{--<a href="#"><p>See more. .</p></a>--}}
                {{--</div>--}}
                {{--<div ng-if="allCategoryResult" ng-repeat="allCategory in allCategoryResult">--}}
                    {{--<a href="#"><h3>[[ allCategory.title ]]</h3></a>--}}
                    {{--<div style="margin-bottom: 40px;"><span class="glyphicon glyphicon-user blog-icon"></span><div class="blog-icon-description">Admin</div>--}}
                        {{--<span class="glyphicon glyphicon-time blog-icon"></span><div class="blog-icon-description">Time</div>--}}
                        {{--<span class="glyphicon glyphicon-calendar blog-icon"></span><div class="blog-icon-description">Calender</div>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}

                    {{--<p>[[ allCategory.content | limitTo: 250 ]] ... </p>--}}
                    {{--<a href="#"><p>See more. .</p></a>--}}
                {{--</div>--}}
                {{--<div ng-if="noResult">--}}
                    {{--<h2>No result found</h2>--}}
                {{--</div>--}}




                {{--Working--}}

                <div ng-if="!singlePostResult">
                    <div ng-if="allData.length<=0">
                        <h2>No result found</h2>
                    </div>
                    [[currentPage]]
                    <div  ng-repeat="allDatas in allData |startFrom:currentPage*pageSize |limitTo:pageSize">
                        <a href="" ng-click="getSinglePost(allDatas.id,currentPage)"><h3>[[ allDatas.title ]]</h3></a>
                        <div style="margin-bottom: 40px;"><span class="glyphicon glyphicon-user blog-icon"></span><div class="blog-icon-description">Admin</div>
                            <span class="glyphicon glyphicon-time blog-icon"></span><div class="blog-icon-description">[[ allDatas.created_at | timeOnly]]</div>
                            <span class="glyphicon glyphicon-calendar blog-icon"></span><div class="blog-icon-description">[[ allDatas.created_at | dateOnly]]</div>
                        </div>
                        <div class="clearfix"></div>

                        <p>[[ allDatas.content | limitTo: 250 ]] ... </p>
                        <a href="" ng-click="getSinglePost(allDatas.id,currentPage)"><p>See more. .</p></a>
                    </div>


                    <div ng-show="numberOfPages>1" style="margin-bottom: 30px">
                            <button class="btn btn-success" ng-disabled="currentPage == 0" ng-click="currentPage=currentPage-1">
                                Previous
                            </button>
                            <b>Page </b>[[currentPage+1]]<b> of </b>[[numberOfPages]]
                            <button class="btn btn-success" ng-disabled="currentPage+1 >= numberOfPages" ng-click="currentPage=currentPage+1">
                                Next
                            </button>
                    </div>
                </div>
                {{--End working--}}

                <div ng-if="singlePostResult">
                    <h2>[[ singlePostResult.title ]]</h2>

                    <div style="margin-bottom: 40px;"><span class="glyphicon glyphicon-user blog-icon"></span><div class="blog-icon-description">Admin</div>
                        <span class="glyphicon glyphicon-time blog-icon"></span><div class="blog-icon-description">[[ singlePostResult.created_at | timeOnly]]</div>
                        <span class="glyphicon glyphicon-calendar blog-icon"></span><div class="blog-icon-description">[[ singlePostResult.created_at | dateOnly]]</div>
                    </div>

                    <div class="clearfix"></div>

                    <p>[[ singlePostResult.content ]] </p>

                    <button class="btn btn-success" ng-click="pagination(allData)">Back</button>

                </div>




            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="recent_posts" ng-if="singlePostResult">
                    <h3 style="margin-top: 0px;">RELATED POSTS</h3>

                </div>
                <div class="recent_posts" >
                    <h3 style="margin-top: 0px;">RECENT POSTS</h3>
                    <div ng-repeat="allRecent in recentPostResult">
                           <a href="" ng-click="getSinglePost(allRecent.id,currentPage)"><p>[[ allRecent.title ]]</p></a>
                    </div>
                </div>
                <div class="recent_posts">
                    <h3 style="margin-top: 0px;">CATEGORIES</h3>
                    [[ currentPage ]]
                    <p ng-repeat="categories in categoryResult"><a href="" ng-click="getCategory(categories.id)">[[ categories.category ]]</a></p>
                </div>
            </div>
        </div>
        <?php if (Auth::check()) { ?>
            <a href="{{url('addpost')}}" class="btn btn-default" role="button" style="margin: 10px 0px;" >ADD NEW</a>
        <?php } ?>
    </div>

</div>
@stop