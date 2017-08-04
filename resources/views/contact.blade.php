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
                    <div class="banner darken">
                        <h2>HI! I AM IMRUL KAIS</h2><br>
                        <h4>Web developer</h4>
                    </div>
                </div>
                <div class="container">
                    <div class="row" ng-repeat="results in allresult">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <h2>CONTACT ME</h2>
                            <h5>I PROMISE, I WON'T BITE</h5><br>
                            <h4>Address:</h4>
                            <p>[[ results.address ]]</p><br>
                            <h4>I ALSO HANG OUT AT </h4>
                            <div class="contact_social">
                                <div class="social-popout"><a href="[[ results.facebook ]]" target="_blank"><img src="{{asset('dist/images/facebook.png')}}" alt="facebook" /></a></div>
                                <div class="social-popout"><a href="[[ results.twitter ]]"><img src="{{asset('dist/images/twitter.png')}}" alt="twitter" /></a></div>
                                <div class="social-popout"><a href="[[ results.googlePlus ]]" target="_blank"><img src="{{asset('dist/images/googleplus.png')}}" alt="googleplus" /></a></div>
                                <div class="social-popout"><a href="[[ results.linkedIn ]]" target="_blank"><img src="{{asset('dist/images/linkedin.png')}}" alt="linkedin" /></a></div>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <img class="img-responsive" src="{{asset('dist/images/contact.png')}}">
                        </div>

                    </div>
                    <?php if (Auth::check()) { ?>
                        <a href="editcontact" class="btn btn-default" role="button" style="float: right;margin: 10px 0px;" >EDIT</a>
                    <?php } ?>
                </div>
            </div>
            @stop